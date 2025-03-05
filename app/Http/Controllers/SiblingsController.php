<?php

namespace App\Http\Controllers;

use App\Models\Siblings;
use App\Models\Academic;
use App\Models\Cocuriculum;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SiblingsController extends Controller
{
    public function index()
    {
        try {
            // Get all siblings for the current user
            $siblings = Siblings::where('icNum', Auth::user()->login_id)
                              ->orderBy('created_at', 'asc')
                              ->get();
            
            // Debug log to check data
            Log::info('Siblings count: ' . $siblings->count());
            Log::info('User ID: ' . Auth::user()->login_id);
            if ($siblings->count() > 0) {
                Log::info('First sibling data:', $siblings->first()->toArray());
            }
            
            return view('applicant.siblingsForm', compact('siblings'));
            
        } catch (\Exception $e) {
            Log::error('Error in siblings index: ' . $e->getMessage());
            return view('applicant.siblingsForm', ['siblings' => collect([])])
                ->withErrors(['error' => 'Error retrieving siblings data']);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate all sibling entries
            $request->validate([
                'name.*' => 'required|string|max:255',
                'age.*' => 'required|integer|min:0|max:150',
                'dob.*' => 'required|date',
                'occupation.*' => 'required|string|max:255',
                'emp_institude.*' => 'required|string|max:255',
            ]);

            // Soft delete existing siblings instead of hard delete
            Siblings::where('icNum', Auth::user()->login_id)->get()->each(function($sibling) {
                $sibling->delete();
            });

            // Store new siblings data
            $siblingsData = [];
            foreach ($request->name as $key => $value) {
                $siblingsData[] = [
                    'icNum' => Auth::user()->login_id,
                    'siblingName' => $request->name[$key],
                    'siblingAge' => $request->age[$key],
                    'siblingDOB' => $request->dob[$key],
                    'occupation' => $request->occupation[$key],
                    'emp_ins' => $request->emp_institude[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Bulk insert all siblings
            Siblings::insert($siblingsData);

            // After storing siblings, calculate scholarship score
            $this->calculateAndStoreRecommendation();

            // Commit transaction
            DB::commit();

            return redirect()->route('applicant.declaration')->with('success', 'Information saved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in siblings store: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Error saving data: ' . $e->getMessage()]);
        }
    }

    private function calculateAndStoreRecommendation()
    {
        // Get personal data
        $personal = Personal::where('user_id', Auth::user()->login_id)->first();
        if (!$personal) {
            throw new \Exception('Personal information not found');
        }

        // Calculate academic score (70% of total)
        $academic = Academic::where('user_id', Auth::user()->login_id)->first();
        $academicMerits = json_decode($academic->subjectMerit ?? '[]');
        
        $academicScore = 0;
        if (!empty($academicMerits)) {
            // Calculate total merit points obtained
            $totalMeritPoints = array_sum($academicMerits);
            // Maximum possible points for 7 subjects (6 points each)
            $maxPossiblePoints = 7 * 6; // 7 subjects, 6 points each
            // Calculate academic score as 70% weightage
            $academicScore = ($totalMeritPoints / $maxPossiblePoints) * 70;
        }
        

        // Calculate cocuriculum score (20% of total)
        $cocuriculums = Cocuriculum::where('icNum', Auth::user()->login_id)->get();
        
        $cocuriculumScore = 0;
        if ($cocuriculums->count() > 0) {
            // Separate activities by type
            $competitions = $cocuriculums->filter(function($activity) {
                return in_array($activity->cocuType, ['competition', 'sports']);
            });
            
            $clubs = $cocuriculums->filter(function($activity) {
                return $activity->cocuType === 'club';
            });

            // Calculate competition/sports score (max 40 points - 8 activities × 5 points)
            $competitionScore = 0;
            if ($competitions->count() > 0) {
                $competitionPoints = $competitions->sum('merit');
                $maxCompetitionPoints = min($competitions->count(), 8) * 5; // Cap at 8 activities
                $competitionScore = ($competitionPoints / $maxCompetitionPoints) * 10;
            }

            // Calculate club/society score (max 35 points - 7 activities × 5 points)
            $clubScore = 0;
            if ($clubs->count() > 0) {
                $clubPoints = $clubs->sum('merit_role');
                $maxClubPoints = min($clubs->count(), 7) * 5; // Cap at 7 activities
                $clubScore = ($clubPoints / $maxClubPoints) * 10;
            }

            // Calculate final cocuriculum score (20% weight)
            // If student has both types, average them. If only one type, use that score
            $cocuriculumScore = $clubScore + $competitionScore;
        }

        // Calculate financial score (10% of total)
        $father = Father::where('icNum', Auth::user()->login_id)->first();
        $mother = Mother::where('icNum', Auth::user()->login_id)->first();
        $totalIncome = ($father->fatherIncome ?? 0) + ($mother->motherIncome ?? 0);
        
        $financialScore = 0;
        if ($totalIncome <= 7000) {
            $financialScore = 30/30 * 10; // 100% of 10% weight
        } elseif ($totalIncome <= 14000) {
            $financialScore = 20/30 * 10; // 66.67% of 10% weight
        } else {
            $financialScore = 10/30 * 10; // 33.33% of 10% weight
        }

        // Calculate total percentage score (out of 100%)
        $totalScore = $academicScore + $cocuriculumScore + $financialScore;

        // Store applicant data
        $userData = [
            'applicant_id' => Auth::user()->login_id,
            'name' => $personal->name,
            'score' => round($totalScore, 2),
            'updated_at' => now()
        ];

        // Determine where to store based on 80% threshold
        if ($totalScore >= 80) {
            DB::table('recommend_list')->updateOrInsert(
                ['applicant_id' => Auth::user()->login_id],
                $userData
            );
            DB::table('kiv_list')->where('applicant_id', Auth::user()->login_id)->delete();
        } else {
            DB::table('kiv_list')->updateOrInsert(
                ['applicant_id' => Auth::user()->login_id],
                $userData
            );
            DB::table('recommend_list')->where('applicant_id', Auth::user()->login_id)->delete();
        }
    }

    public function destroy($id)
    {
        try {
            $sibling = Siblings::findOrFail($id);
            
            // Check if sibling belongs to current user
            if ($sibling->icNum !== Auth::user()->login_id) {
                Log::warning('Unauthorized deletion attempt for sibling ID: ' . $id . ' by user: ' . Auth::user()->login_id);
                return response()->json(['error' => 'Unauthorized access'], 403);
            }

            // Use soft delete
            if ($sibling->delete()) {
                Log::info('Sibling soft deleted successfully. ID: ' . $id);
                return response()->json(['success' => true, 'message' => 'Sibling deleted successfully']);
            } else {
                throw new \Exception('Failed to delete sibling');
            }

        } catch (\Exception $e) {
            Log::error('Error soft deleting sibling: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete sibling: ' . $e->getMessage()], 500);
        }
    }
}
