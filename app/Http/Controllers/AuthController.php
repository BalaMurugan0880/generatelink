<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{

    public function showLoginForm()
{
    if (Auth::check()) {
        return redirect()->route('appointments.index');
    }

    return view('auth.login');
}

public function login(Request $request)
{

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('appointments.index');
    } else {
        $errorMessage = 'Invalid email or password.';
        session()->flash('error', $errorMessage);
        return redirect()->back();
    }
}

public function logout(Request $request) {
    Auth::logout();
    return redirect('/');
}

}
