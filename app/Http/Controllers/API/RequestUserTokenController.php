<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestUserTokenController extends Controller
{
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

        return $user->createToken($user->name)->plainTextToken;
    }
}
