<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        if (Auth::attempt($data)) {
            return redirect()->route('post.index');
        }
        return back()->with('login_error', '※メールアドレスまたはパスワードが違います。');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
