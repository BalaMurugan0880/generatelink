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
    $client = new Client([
        'base_uri' => 'https://api.staging.europ-assistance.my',
        'auth' => ['C54B5730DF624A58AF77C319FCE2FA93', '285eb345f5c6dbbc3d0d17f7350f039deedce7b6'],
        'verify' => false, // enable SSL/TLS certificate verification
    ]);

    try {
        $response = $client->post('/api/auth/customer/login', [
            'json' => [
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);

        $accessToken = json_decode((string) $response->getBody(), true)['accessToken'];

        // dd($accessToken);

        // Check if user exists in database based on email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // If user doesn't exist, create a new user with a random password and log them in
            $password = '1234';

            $user = User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($password),
                'access_token' => $accessToken,
            ]);
        }else {
            // If user exists, update their access token
            $user->access_token = $accessToken;
            $user->save();
        }

        $user->tokens()->delete();

        $user->createToken('api-token', ['role:customer'])->plainTextToken;

        Auth::login($user);

        return redirect()->route('appointments.index');

    } catch (ClientException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        $errorMessage = json_decode((string) $e->getResponse()->getBody(), true)['message'];

        session()->flash('error', $errorMessage);
        return redirect()->back();

    }
}

public function logout(Request $request) {
    Auth::logout();
    return redirect('/');
}

}
