<?php

namespace App\Http\Controllers;

use App\Models\Kiv;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Academic;
use App\Models\Guardian;
use App\Models\Personal;
use App\Models\Siblings;
use App\Models\Recommend;
use App\Models\Cocuriculum;
use Illuminate\Http\Request;

class KivController extends Controller
{
    public function index()
    {
        $kivCandidates = Kiv::all();
        return view('admin.kiv', compact('kivCandidates'));
    }

    public function view($id)
    {
        $candidate = Kiv::findOrFail($id);
        $personal = Personal::where('icNum', $candidate->applicant_id)->firstOrFail();
        $academic = Academic::where('applicant_id', $candidate->applicant_id)->get();
        $cocurriculums = Cocuriculum::where('applicant_id', $candidate->applicant_id)->get();
        $siblings = Siblings::where('applicant_id', $candidate->applicant_id)->get();

        return view('admin.application.view', compact('personal', 'academic', 'cocurriculums', 'siblings'));
    }

    public function edit($id)
    {
        $candidate = Kiv::findOrFail($id);
        $personal = Personal::where('user_id', $candidate->applicant_id)->first();
        
        return view('admin.editApplicant', compact('candidate', 'personal'));
    }

    public function update(Request $request, $id)
    {
        try {
            $candidate = Kiv::findOrFail($id);

            if ($request->action === 'approve') {
                // Create new record in recommend table
                Recommend::create([
                    'applicant_id' => $candidate->applicant_id,
                    'name' => $candidate->name,
                    'score' => $candidate->score,
                    'remark' => $request->remark  
                ]);

                // Delete from KIV table
                $candidate->delete();

                return redirect()->route('kiv.index')
                    ->with('success', 'Candidate successfully moved to recommended list');
            }

            return redirect()->route('kiv.index')
                ->with('error', 'Invalid action specified');
        } catch (\Exception $e) {
            \Log::error('Error in approve method: ' . $e->getMessage());
            return back()->with('error', 'Error processing approval');
        }
    }

    public function viewCandidate($id)
    {
        try {
            $candidate = Kiv::findOrFail($id);
            $applicant_id = $candidate->applicant_id;

            // Fetch all related data
            $personal = Personal::where('user_id', $applicant_id)->first();
            $academic = Academic::where('user_id', $applicant_id)->first();
            $cocuriculums = Cocuriculum::where('icNum', $applicant_id)->get();
            $father = Father::where('icNum', $applicant_id)->first();
            $mother = Mother::where('icNum', $applicant_id)->first();
            $guardian = Guardian::where('icNum', $applicant_id)->first();
            $siblings = Siblings::where('icNum', $applicant_id)->get();

            // Debug information
            \Log::info('Academic data:', [
                'academic' => $academic,
                'subjects' => $academic ? json_decode($academic->subjectName) : null
            ]);

            return view('admin.viewCandidate', compact(
                'candidate',
                'personal',
                'academic',
                'cocuriculums',
                'father',
                'mother',
                'guardian',
                'siblings'
            ));
        } catch (\Exception $e) {
            \Log::error('Error in view method: ' . $e->getMessage());
            return back()->with('error', 'Error loading candidate details');
        }
    }
}
