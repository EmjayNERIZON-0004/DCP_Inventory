<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolUser;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // your Blade view
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'fromAdmin' => 'nullable'
        ]);

        if ($request->fromAdmin) {
            session()->flush();
        }
        if ($request->username == "admin" && $request->password == "admin") {
            session(['UserRole' => 'Admin']);
            session(['admin_logged_in' => true]);
            return redirect()->route('AdminSide-Dashboard');
        } else {
            $users = SchoolUser::where('username', $request->username)->get();
            // dd($request->password);
            session(['UserRole' => 'School']);

            foreach ($users as $user) {
                if (Hash::check($request->password, $user->password)) {
                    Auth::guard('school')->login($user, $request->has('remember'));
                    $user->last_login = now();
                    $user->save();
                    return redirect()->intended('School/profile');
                }
            }
        }
        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout()
    {
        if (session()->has('admin_logged_in')) {
            session()->forget('admin_logged_in');
            return redirect()->route('login');
        }
        Auth::guard('school')->logout();
        return redirect()->route('login');
    }
}
