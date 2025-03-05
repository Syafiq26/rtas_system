<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GuardianController extends Controller
{
    public function index()
    {
        $guardian = Guardian::where('icNum', Auth::user()->login_id)->first();
        return view('applicant.guardian', compact('guardian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ic' => 'required|string|max:20',
            'citizenship' => 'required|string|max:100',
            'gender' => 'required|string|in:male,female',
            'relation' => 'required|string',
            'dob' => 'required|date',
            'pob' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'occupation' => 'required|string|max:255',
            'phoneNum' => 'required|string|max:20',
            'empName' => 'required|string|max:255',
            'empAddress' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'income' => 'required|numeric|min:0',
            'copyIC' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'copySalary' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            $guardianData = [
                'name' => $validated['name'],
                'ic' => $validated['ic'],
                'citizen' => $validated['citizenship'],
                'gender' => $validated['gender'],
                'relation' => $validated['relation'],
                'dob' => $validated['dob'],
                'pob' => $validated['pob'],
                'age' => $validated['age'],
                'occupation' => $validated['occupation'],
                'phoneNum' => $validated['phoneNum'],
                'empName' => $validated['empName'],
                'empAddress' => $validated['empAddress'],
                'postcode' => $validated['postcode'],
                'email' => $validated['email'],
                'income' => $validated['income'],
                'icNum' => Auth::user()->login_id,
            ];

            // Handle file uploads
            if ($request->hasFile('copyIC')) {
                $file = $request->file('copyIC');
                $filename = 'guardian_ic_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
                $guardianData['copyIC'] = $file->storeAs('guardian_docs', $filename, 'public');
            }

            if ($request->hasFile('copySalary')) {
                $file = $request->file('copySalary');
                $filename = 'guardian_salary_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
                $guardianData['copySalaryLocation'] = $file->storeAs('guardian_docs', $filename, 'public');
            }

            Guardian::updateOrCreate(
                ['icNum' => Auth::user()->login_id],
                $guardianData
            );

            return redirect()->route('parent.form')->with('success', 'Guardian information saved successfully!');

        } catch (\Exception $e) {
            Log::error('Guardian form error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error saving data: ' . $e->getMessage()]);
        }
    }
}
