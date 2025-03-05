<?php

namespace App\Http\Controllers;

use App\Models\Father;
use App\Models\Mother;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ParentController extends Controller
{
    public function index()
    {
        $father = Father::where('icNum', Auth::user()->login_id)->first();
        $mother = Mother::where('icNum', Auth::user()->login_id)->first();
        return view('applicant.parentForm', compact('father', 'mother'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'fatherName' => 'required|string|max:255',
            'fatherIC' => 'required|string|max:20',
            'fatherCitizen' => 'required|string|max:100',
            'fatherDOB' => 'required|date',
            'fatherPOB' => 'required|string|max:255',
            'fatherAge' => 'required|integer|min:1|max:150',
            'fatherOccupation' => 'required|string|max:255',
            'fatherPhone' => 'required|string|max:20',
            'fatherEmployerName' => 'required|string|max:255',
            'fatherEmpAddress' => 'required|string|max:255',
            'fatherPostcode' => 'required|string|max:10',
            'fatherEmail' => 'required|email|max:255',
            'fatherSalary' => 'required|numeric|min:0',
            'fatherIcFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'fatherSalaryFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'motherName' => 'required|string|max:255',
            'motherIC' => 'required|string|max:20',
            'motherCitizen' => 'required|string|max:100',
            'motherDOB' => 'required|date',
            'motherPOB' => 'required|string|max:255',
            'motherAge' => 'required|integer|min:1|max:150',
            'motherOccupation' => 'required|string|max:255',
            'motherPhone' => 'required|string|max:20',
            'motherEmployerName' => 'required|string|max:255',
            'motherEmpAddress' => 'required|string|max:255',
            'motherPostcode' => 'required|string|max:10',
            'motherEmail' => 'required|email|max:255',
            'motherSalary' => 'required|numeric|min:0',
            'motherIcFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'motherSalaryFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            // Father data mapping
            $fatherData = [
                'fatherName' => $request->input('fatherName'),
                'fatherIC' => $request->input('fatherIC'),
                'citizen' => $request->input('fatherCitizen'),
                'fatherDOB' => $request->input('fatherDOB'),
                'fatherPOB' => $request->input('fatherPOB'),
                'fatherAge' => (int)$request->input('fatherAge'),
                'occupation' => $request->input('fatherOccupation'),
                'fatherPhone' => $request->input('fatherPhone'),
                'fatherEmployer' => $request->input('fatherEmployerName'),
                'addressEmployer' => $request->input('fatherEmpAddress'),
                'postcode' => $request->input('fatherPostcode'),
                'fatherEmail' => $request->input('fatherEmail'),
                'fatherIncome' => $request->input('fatherSalary'),
                'icNum' => Auth::user()->login_id
            ];

            // Mother data mapping
            $motherData = [
                'motherName' => $request->input('motherName'),
                'motherIC' => $request->input('motherIC'),
                'citizen' => $request->input('motherCitizen'),
                'motherDOB' => $request->input('motherDOB'),
                'motherPOB' => $request->input('motherPOB'),
                'motherAge' => (int)$request->input('motherAge'),
                'occupation' => $request->input('motherOccupation'),
                'motherPhone' => $request->input('motherPhone'),
                'motherEmployer' => $request->input('motherEmployerName'),
                'addressEmployer' => $request->input('motherEmpAddress'),
                'postcode' => $request->input('motherPostcode'),
                'motherEmail' => $request->input('motherEmail'),
                'motherIncome' => $request->input('motherSalary'),
                'icNum' => Auth::user()->login_id
            ];

            // Handle father's files
            if ($request->hasFile('fatherIcFile')) {
                $file = $request->file('fatherIcFile');
                $filename = 'father_ic_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
                $fatherData['copyIC'] = $file->storeAs('parent_docs', $filename, 'public');
            }

            if ($request->hasFile('fatherSalaryFile')) {
                $file = $request->file('fatherSalaryFile');
                $filename = 'father_salary_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
                $fatherData['copySalaryLocation'] = $file->storeAs('parent_docs', $filename, 'public');
            }

            // Handle mother's files
            if ($request->hasFile('motherIcFile')) {
                $file = $request->file('motherIcFile');
                $filename = 'mother_ic_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
                $motherData['copyIC'] = $file->storeAs('parent_docs', $filename, 'public');
            }

            if ($request->hasFile('motherSalaryFile')) {
                $file = $request->file('motherSalaryFile');
                $filename = 'mother_salary_' . Auth::user()->login_id . '.' . $file->getClientOriginalExtension();
                $motherData['copySalaryLocation'] = $file->storeAs('parent_docs', $filename, 'public');
            }

            // Debug logging
            Log::info('Father Data:', $fatherData);
            Log::info('Mother Data:', $motherData);

            // Save data with error catching
            $father = Father::updateOrCreate(
                ['icNum' => Auth::user()->login_id],
                $fatherData
            );

            $mother = Mother::updateOrCreate(
                ['icNum' => Auth::user()->login_id],
                $motherData
            );

            // Initialize empty siblings collection for the siblingsForm view
            $siblings = collect([]);
            
            return view('applicant.siblingsForm', compact('siblings'))
                ->with('success', 'Parent information saved successfully!');

        } catch (\Exception $e) {
            Log::error('Parent form error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error saving data: ' . $e->getMessage()]);
        }
    }
}
