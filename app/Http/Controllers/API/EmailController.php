<?php

namespace App\Http\Controllers\API;

use App\Enums\DeliveryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmailRequest;
use App\Models\Email;
use Request;

class EmailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmailRequest $request)
    {
        $email = $request->store();

        return response()->noContent(headers: [
            'X-Email-ID' => $email->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        if ($email->user_id !== auth()->id()) {
            abort(403, 'Get out of here!');
        }

        if ($email->status == DeliveryStatus::SENT) {
            abort(406, 'Too late, we sent this out already.');
        }

        $email->delete();

        return response()->noContent();
    }
}
