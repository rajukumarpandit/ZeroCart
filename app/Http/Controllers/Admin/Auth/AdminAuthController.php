<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {

            $user = Auth::user();

            // 🔐 ROLE CHECK
            if (! $user->hasAnyRole(['super_admin', 'admin'])) {
                Auth::logout();
                session()->flash('success','You are not allowed to access admin panel!');
                return back()->withErrors([
                    'email' => 'You are not allowed to access admin panel',
                ]);
            }

            auditLog('User logged In',$user,['role' => $user->type ?? 'N/A']);
            session()->flash('success','Logged in successfully!');
            return redirect()->route('admin.dashboard');
        }
        session()->flash('error','Invalid login credentials!');
        return back()->withErrors([
            'email' => 'Invalid login credentials',
        ]);
    }

    public function logout(Request $request)
    {
        $user = auth()->user(); // 👈 capture before logout
        auditLog('User logged out',$user,['role' => $user->type ?? 'N/A']);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('success','Logged Out successfully!');
        return redirect()->route('admin.login');
    }
}