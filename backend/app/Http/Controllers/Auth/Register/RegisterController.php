<?php

namespace App\Http\Controllers\Auth\Register;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('auth.register_form');
    }

    public function register(RegisterRequest $request)
    {
        $user = new User;

        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);

        $user->fill($data)->save();

        return redirect()->route('register.added');
    }

    public function registerAdded()
    {
        return view('auth.register_added');
    }
}
