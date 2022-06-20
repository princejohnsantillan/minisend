<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        return inertia('Email/Index', [
            'emails' => $user->emails,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function show(Email $email)
    {
        return inertia('Email/Show');
    }
}
