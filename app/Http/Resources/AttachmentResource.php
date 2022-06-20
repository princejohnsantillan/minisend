<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var \App\Models\Attachment */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'filename' => $resource->original_filename,
            'link' => $resource->download_link,
        ];
    }
}
