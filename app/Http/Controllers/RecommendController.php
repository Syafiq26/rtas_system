<?php

namespace App\Http\Controllers;

use App\Models\Father;
use App\Models\Mother;
use App\Models\Academic;
use App\Models\Guardian;
use App\Models\Personal;
use App\Models\Siblings;
use App\Models\Recommend;
use App\Models\Cocuriculum;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    public function index()
    {
        $applicants = Recommend::all();
        return view('admin.recommend', compact('applicants'));
    }

    public function view($id)
    {
        $candidate = Recommend::findOrFail($id);
        $personal = Personal::where('icNum', $candidate->icNum)->firstOrFail();
        $academic = Academic::where('applicant_id', $candidate->icNum)->get();
        $cocurriculums = Cocuriculum::where('applicant_id', $candidate->icNum)->get();
        $siblings = Siblings::where('applicant_id', $candidate->icNum)->get();

        return view('admin.application.view', compact('personal', 'academic', 'cocurriculums', 'siblings'));
    }

    public function viewCandidate($id)
    {
        try {
            $candidate = Recommend::findOrFail($id);
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
