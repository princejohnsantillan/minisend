<?php

namespace App\Http\Controllers\Web;

use App\Enums\DeliveryStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\EmailResource;
use App\Models\Attachment;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $parameters = $request->validate([
            'search' => ['nullable'],
            'per_page' => ['nullable', 'integer', 'min:10'],
        ]);

        $search = isset($parameters['search'])
            ? str($parameters['search'])->squish()->replace(' ', '%')->value()
            : null;

        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        $emails = $user->emails()
            ->when(isset($search), fn ($query) => $query->where('subject', 'like', "%$search%")
                ->orWhere('from_name', 'like', "%$search%")
                ->orWhere('from_email', 'like', "%$search%")
                ->orWhere('to_name', 'like', "%$search%")
                ->orWhere('to_email', 'like', "%$search%")
            )
            ->paginate($parameters['per_page'] ?? 10);

        return inertia('Email/Index', [
            'emails' => EmailResource::collection($emails),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function show(Email $email)
    {
        return inertia('Email/Show', [
            'email' => new EmailResource($email),
            'attachments' => AttachmentResource::collection($email->attachments),
        ]);
    }
}
