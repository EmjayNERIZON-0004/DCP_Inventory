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
                'password' => 'required'
            ]);

          if($request->username == "admin"){
            return redirect()->route('AdminSide-Dashboard');
          }      
          
else {
    $users = SchoolUser::where('username', $request->username)->get();

    foreach ($users as $user) {
        if (Hash::check($request->password, $user->password)) {
            Auth::guard('school')->login($user, $request->has('remember'));
            return redirect()->intended('School/profile');
        }
    }
}
return back()->withErrors(['login' => 'Invalid credentials']);
            }

    public function logout()
    {
        Auth::guard('school')->logout();
        return redirect()->route('login');
    }
}
