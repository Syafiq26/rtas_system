<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('login_id', $request->login_id)->first();

        if ($user) {
            Auth::login($user);
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'interviewer') {
                return redirect()->route('interviewer.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('applicant.home');
            } else {
                return redirect()->back()->with('error', 'Invalid role');
            }
        }

        return redirect()->back()->with('error', 'Invalid login ID');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
