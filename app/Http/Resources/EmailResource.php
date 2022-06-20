<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Email
 */
class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var \App\Models\Email */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'subject' => $resource->subject,
            'from' => [
                'email' => $resource->from_email,
                'name' => $resource->from_name,
            ],
            'to' => [
                'email' => $resource->to_email,
                'name' => $resource->to_name,
            ],
            'text' => $resource->text,
            'html' => $resource->html,
            'status' => $resource->status->value,
            'posted_at' => $resource->posted_at_string,
        ];
    }
}
