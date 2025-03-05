<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = User::whereNotIn('role', ['user'])->get();
        return view('admin.assignStaff', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_id' => 'required|unique:users',
            'name' => 'required',
            'role' => 'required|in:1,2'
        ]);

        // Convert role number to name
        $roleName = $request->role == '1' ? 'admin' : 'interviewer';

        User::create([
            'login_id' => $request->login_id,
            'name' => $request->name,
            'role' => $roleName
        ]);

        return redirect()->route('staff.assign')
            ->with('success', 'Staff added successfully');
    }

    public function view($id)
    {
        $staff = User::findOrFail($id);
        return view('admin.viewStaff', compact('staff'));
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('admin.editStaff', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required|in:1,2'
        ]);

        // Convert role number to name
        $roleName = $request->role == '1' ? 'admin' : 'interviewer';

        $staff = User::findOrFail($id);
        $staff->update([
            'name' => $request->name,
            'role' => $roleName
        ]);

        return redirect()->route('staff.assign')
            ->with('success', 'Staff updated successfully');
    }

    public function destroy($id)
    {
        try {
            $staff = User::findOrFail($id);
            $staff->delete();
            
            return redirect()->route('staff.assign')
                ->with('success', 'Staff deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting staff');
        }
    }
}
