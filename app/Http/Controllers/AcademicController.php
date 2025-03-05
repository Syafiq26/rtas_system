<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Academic;

class AcademicController extends Controller
{
    public function index()
    {
        $academic = Academic::where('user_id', Auth::user()->login_id)->first();
        return view('applicant.academicForm', compact('academic'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'major' => 'required|string|max:255',
            'schoolName' => 'required|string|max:255',
            'subject' => 'required|array',
            'grade' => 'required|array',
            'spmCert' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $subjectName = $validated['subject'];
        $subjectGrade = [];
        $subjectMerit = [];
        $meritMapping = [
            'A+' => 6, 'A' => 5, 'A-' => 4,
            'B+' => 3, 'B' => 2, 'B-' => 1,
            'C+' => 0, 'C' => 0, 'C-' => 0,
            'D' => 0, 'E' => 0, 'F' => 0,
        ];

        foreach ($validated['subject'] as $index => $subject) {
            $grade = $validated['grade'][$index];
            $subjectGrade[] = $grade;
            $subjectMerit[] = $meritMapping[$grade] ?? 0;
        }

        $validated['subjectName'] = json_encode($subjectName);
        $validated['subjectGrade'] = json_encode($subjectGrade);
        $validated['subjectMerit'] = json_encode($subjectMerit);
        $validated['user_id'] = Auth::user()->login_id;

        if ($request->hasFile('spmCert')) {
            $file = $request->file('spmCert');
            $filename = 'spm_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('spm_certs', $filename, 'public');
            $validated['spmCertLocation'] = $path;
        }

        Academic::updateOrCreate(
            ['user_id' => Auth::user()->login_id],
            $validated
        );

        return redirect()->route('cocuriculum.form')->with('success', 'Academic details have been successfully saved!');
    }
}
