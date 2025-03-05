<?php

namespace App\Http\Controllers\Interviewer;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use App\Models\Recommend;
use App\Models\Academic;
use App\Models\Father;
use App\Models\Mother;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCandidates = Personal::count();
        $recommendedCount = Recommend::count();

        // Calculate household income ranges
        $householdIncomes = $this->getHouseholdIncomes();
        $b40Count = $householdIncomes->filter(function($total) {
            return $total <= 7000;
        })->count();
        
        $m40Count = $householdIncomes->filter(function($total) {
            return $total > 7000 && $total <= 14000;
        })->count();
        
        $t20Count = $householdIncomes->filter(function($total) {
            return $total > 14000;
        })->count();

        // Get field of study data
        $scienceReligion = Academic::where('major', 'Science Religion')->orWhere('major', 'agama')->count();
        $pureScienceCount = Academic::where('major', 'Pure Science')->orWhere('major', 'tulen')->count();

        // Get score ranges
        $score90to100 = Recommend::where('score', '>=', 90)->count();
        $score80to89 = Recommend::whereBetween('score', [80, 89])->count();
        $score70to79 = Recommend::whereBetween('score', [70, 79])->count();
        $scoreBelowCount = Recommend::where('score', '<', 70)->count();

        return view('interviewer.dashboard', compact(
            'totalCandidates',
            'recommendedCount',
            'b40Count',
            'm40Count',
            't20Count',
            'scienceReligion',
            'pureScienceCount',
            'score90to100',
            'score80to89',
            'score70to79',
            'scoreBelowCount'
        ));
    }

    private function getHouseholdIncomes()
    {
        $familyIds = Father::pluck('icNum')->merge(Mother::pluck('icNum'))->unique();
        
        return $familyIds->map(function($icNum) {
            $fatherIncome = Father::where('icNum', $icNum)->value('fatherIncome') ?? 0;
            $motherIncome = Mother::where('icNum', $icNum)->value('motherIncome') ?? 0;
            return $fatherIncome + $motherIncome;
        });
    }
}
