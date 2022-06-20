<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (auth()->check()) {
            return redirect()->intended();
        }

        return inertia('Login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required'],
        ]);

        /** @var \App\Models\User|null $tokenUser */
        $tokenUser = PersonalAccessToken::findToken($credentials['token'])?->tokenable;

        if ($tokenUser?->email === $credentials['email']) {
            Auth::login($tokenUser);

            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' =>  'The provided credentials do not match our records.',
        ]);
    }
}
