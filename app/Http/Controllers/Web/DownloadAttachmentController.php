<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attachment;

class DownloadAttachmentController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Attachment $attachment)
    {
        if ($attachment->email->user_id !== auth()->id()) {
            abort(403, 'Get out of here!');
        }

        return $attachment->disk->storage()
            ->download($attachment->storage_filename, $attachment->original_filename);
    }
}
