<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = User::firstWhere('email', $credentials['email']);

        if ($user?->tokens()->where('id', $credentials['token'])->exists()) {
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' =>  'The provided credentials do not match our records.',
        ]);
    }
}
