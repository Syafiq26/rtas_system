<?php

namespace App\Http\Controllers;

use App\Models\Father;
use App\Models\Mother;
use App\Models\Academic;
use App\Models\Guardian;
use App\Models\Personal;
use App\Models\Question;
use App\Models\Siblings;
use App\Models\Recommend;
use App\Models\Cocuriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewerController extends Controller
{
    /**
     * Display the list of recommended candidates.
     *
     * @return \Illuminate\View\View
     */
    public function recommendList()
    {
        $recommendedCandidates = Recommend::all();
        return view('interviewer.recommendList', compact('recommendedCandidates'));
    }

    public function showQuestions($id)
    {
        $candidate = Recommend::findOrFail($id);
        $questions = Question::where('candidate_id', $candidate->applicant_id)
            ->where('interviewer_id', Auth::user()->login_id) // Add this line to filter by logged-in interviewer
            ->get()
            ->keyBy('category');
        return view('interviewer.question', compact('candidate', 'questions'));
    }

    public function storeQuestions(Request $request, $id)
    {
        $request->validate([
            'questions.*.marks' => 'required|numeric|min:0|max:5', // Changed max from 10 to 5
            'questions.*.comment' => 'nullable|string|max:255',
        ]);

        $candidate = Recommend::findOrFail($id);
        $interviewer_id = Auth::user()->login_id; // Changed from Auth::id() to get login_id
        
        Question::where('candidate_id', $candidate->applicant_id)->delete();

        $validCategories = [
            'self_introduction' => 'self_introduction',
            'appearance' => 'appearance',
            'communication' => 'communication',
            'attitude' => 'attitude',
            'general' => 'general',
            'selfMotivation' => 'selfMotivation'
        ];

        foreach ($request->questions as $category => $data) {
            if (isset($validCategories[$category])) {
                Question::create([
                    'candidate_id' => $candidate->applicant_id,
                    'interviewer_id' => $interviewer_id, // Add interviewer_id
                    'category' => $validCategories[$category],
                    'marks' => intval($data['marks']),
                    'comment' => strval($data['comment'] ?? '')
                ]);
            }
        }

        return redirect()->route('interviewer.recommendList')
            ->with('success', 'Interview questions saved successfully');
    }

    public function view($id)
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

            return view('interviewer.viewCandidate', compact(
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

    public function interviewerMark(Request $request)
    {
        $candidates = Recommend::with(['personal'])->get()->map(function ($candidate) {
            // Get scores grouped by category and calculate averages
            $scores = DB::table('questions')
                ->select('category', DB::raw('SUM(marks) as total_marks'))
                ->where('candidate_id', $candidate->applicant_id)
                ->groupBy('category')
                ->get()
                ->map(function ($score) {
                    return [
                        'category' => $score->category,
                        'average_mark' => ceil($score->total_marks / 3)
                    ];
                });

            // Calculate total average score
            $totalAverage = ceil($scores->sum('average_mark'));
            
            // Count distinct interviewers
            $distinctInterviewers = DB::table('questions')
                ->where('candidate_id', $candidate->applicant_id)
                ->distinct('interviewer_id')
                ->count('interviewer_id');

            return [
                'ic' => $candidate->applicant_id,
                'name' => $candidate->personal->name ?? 'N/A',
                'score' => $totalAverage,
                'interviewer_count' => $distinctInterviewers
            ];
        });

        $viewPath = $request->is('admin/*') ? 'admin.interviewerMark' : 'interviewer.interviewerMark';
        return view($viewPath, compact('candidates'));
    }

    public function viewInterviewMark(Request $request, $id)
    {
        $candidate = Recommend::with(['personal', 'questions'])->where('applicant_id', $id)->firstOrFail();
        
        // Check if request is from admin or interviewer route
        $viewPath = $request->is('admin/*') ? 'admin.viewMark' : 'interviewer.viewMark';
        return view($viewPath, compact('candidate'));
    }

    public function viewIVMark($id)
    {
        $candidate = Recommend::with(['personal'])->where('applicant_id', $id)->firstOrFail();
        
        // Get scores grouped by interviewer and category with interviewer names
        $questionsByInterviewer = DB::table('questions')
            ->join('users', 'questions.interviewer_id', '=', 'users.login_id')
            ->select(
                'questions.interviewer_id',
                'users.name as interviewer_name',
                'questions.category',
                'questions.marks',
                'questions.comment'
            )
            ->where('questions.candidate_id', $id)
            ->get()
            ->groupBy('interviewer_id');

        // Calculate total score per category
        $categoryScores = DB::table('questions')
            ->select('category', DB::raw('SUM(marks) as total_marks'))
            ->where('candidate_id', $id)
            ->groupBy('category')
            ->get()
            ->map(function ($score) {
                return [
                    'category' => $score->category,
                    'average_mark' => ceil($score->total_marks / 3)
                ];
            });

        $totalScore = ceil($categoryScores->sum('average_mark'));
        $distinctInterviewers = DB::table('questions')
            ->where('candidate_id', $id)
            ->distinct('interviewer_id')
            ->count('interviewer_id');

        return view('admin.viewIVMark', compact(
            'candidate',
            'questionsByInterviewer',
            'categoryScores',
            'totalScore',
            'distinctInterviewers'
        ));
    }
}
