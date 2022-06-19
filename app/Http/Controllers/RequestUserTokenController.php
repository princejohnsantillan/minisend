<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RequestUserTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $user = User::query()->firstOrNew($request->only(['email']));

        $user->name = $data['name'];

        $user->password = bcrypt(Str::random(16));

        $user->save();

        $token = $user->createToken($user->name);

        return $token->plainTextToken;
    }
}
