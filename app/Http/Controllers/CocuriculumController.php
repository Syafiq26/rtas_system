<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cocuriculum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CocuriculumController extends Controller
{
    private $representMerits = [
        'international' => 5,
        'country' => 4,
        'state' => 3,
        'district' => 2,
        'school' => 1
    ];

    private $roleMerits = [
        'president' => 5,
        'vice_president' => 4,
        'secretary' => 3,
        'committee' => 2,
        'member' => 1
    ];

    public function index()
    {
        $cocuriculums = Cocuriculum::where('icNum', Auth::user()->login_id)->get();
        return view('applicant.cocuriculumForm', compact('cocuriculums'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cocuName.*' => 'required|string|max:255',
                'cocuType.*' => 'required|string|max:255',
                'represent.*' => 'required|string|max:255',
                'role.*' => 'required|string|max:255',
                'copyCertLocation.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            DB::beginTransaction();

            // Get all existing records IDs for this user
            $existingIds = Cocuriculum::where('icNum', Auth::user()->login_id)
                                    ->pluck('id')
                                    ->toArray();
            $processedIds = [];

            // Process each row
            foreach ($request->cocuName as $key => $name) {
                $data = [
                    'icNum' => Auth::user()->login_id,
                    'cocuName' => $name,
                    'cocuType' => $request->cocuType[$key],
                    'represent' => $request->represent[$key],
                    'role' => $request->role[$key],
                    'merit' => $this->representMerits[$request->represent[$key]] ?? 0,
                    'merit_role' => $this->roleMerits[$request->role[$key]] ?? 0,
                ];

                // Handle file upload if new file is provided
                if ($request->hasFile('copyCertLocation.' . $key)) {
                    $file = $request->file('copyCertLocation.' . $key);
                    $cocuId = 'COCU' . Str::random(8);
                    $filename = 'cocu_' . $cocuId . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('cocu_certs', $filename, 'public');
                    $data['copyCertLocation'] = $path;
                }

                // If there's a hidden input for existing record ID
                if (isset($request->cocu_id[$key]) && !empty($request->cocu_id[$key])) {
                    $id = $request->cocu_id[$key];
                    $record = Cocuriculum::find($id);
                    
                    if ($record && $record->icNum === Auth::user()->login_id) {
                        $record->update($data);
                        $processedIds[] = $id;
                    }
                } else {
                    // Create new record if no ID exists
                    $data['cocuId'] = 'COCU' . Str::random(8);
                    $record = Cocuriculum::create($data);
                    $processedIds[] = $record->id;
                }
            }

            // Delete records that weren't updated or created
            $recordsToDelete = array_diff($existingIds, $processedIds);
            if (!empty($recordsToDelete)) {
                Cocuriculum::whereIn('id', $recordsToDelete)
                    ->where('icNum', Auth::user()->login_id)
                    ->delete();
            }

            DB::commit();
            return redirect()->route('parent.form')->with('success', 'Co-curriculum information saved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving cocuriculum: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Error saving data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $cocu = Cocuriculum::findOrFail($id);
            if ($cocu->icNum !== Auth::user()->login_id) {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            $cocu->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
