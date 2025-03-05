<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        // Get personal details for logged in user using login_id
        $personal = Personal::where('user_id', Auth::user()->login_id)->first();
        return view('applicant.personalForm', compact('personal'));
    }

    public function store(Request $request)
    {
        // Add debugging
        Log::info('Form submitted', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ic' => 'required|string|max:20', 
            'icFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'citizen' => 'required|string|max:100',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'pob' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'postcode' => 'required|string|max:10',
            'state' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Map 'ic' to 'icNum' and 'phone' to 'phoneNum' for database storage
        $validated['icNum'] = $validated['ic'];
        $validated['phoneNum'] = $validated['phone'];
        unset($validated['ic'], $validated['phone']);

        // Add user_id (login_id) to validated data
        $validated['user_id'] = Auth::user()->login_id;

        if ($request->hasFile('icFile')) {
            $file = $request->file('icFile');
            $extension = $file->getClientOriginalExtension();
            $filename = $validated['icNum'] . '.' . $extension;
            
            // Store with custom filename
            $path = $file->storeAs('ic_copies', $filename, 'public');
            $validated['copyIC'] = $path;
        }

        try {
            DB::beginTransaction();
            
            // Update or create based on user_id (login_id)
            Personal::updateOrCreate(
                ['user_id' => Auth::user()->login_id], // Key to find existing record
                $validated // Data to update or create
            );
            
            DB::commit();
            $message = $request->input('personal_id') ? 
                'Personal details have been successfully updated!' : 
                'Personal details have been successfully saved!';
            return back()->with('success', $message . ' Redirecting to Academic Form...');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saving personal details: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error saving personal details. Please try again.');
        }
    }
}
