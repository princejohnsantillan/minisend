<?php

namespace App\Http\Requests;

use App\Enums\DeliveryStatus;
use App\Enums\StorageDisk;
use App\Models\Attachment;
use App\Models\Email;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $text = ['txt', 'csv', 'log', 'css', 'ics', 'xml'];
        $image = ['jpg', 'jpe', 'jpeg', 'gif', 'png', 'bmp', 'psd', 'tif', 'tiff', 'svg', 'indd', 'ai', 'eps'];
        $document = ['doc', 'docx', 'rtf', 'odt', 'ott', 'pdf', 'pub', 'pages', 'mobi', 'epub'];
        $audio = ['mp3', 'm4a', 'm4v', 'wma', 'ogg', 'flac', 'wav', 'aif', 'aifc', 'aiff'];
        $video = ['mp4', 'mov', 'avi', 'mkv', 'mpeg', 'mpg', 'wmv'];
        $spreadsheet = ['xls', 'xlxs', 'ods', 'numbers'];
        $presentation = ['odp', 'ppt', 'pptx', 'pps', 'key'];
        $archive = ['zip', 'vcf'];

        $mimes = 'mimes:'
            .collect([
                $text,
                $image,
                $document,
                $audio,
                $video,
                $spreadsheet,
                $presentation,
                $archive,
            ])->flatten()->join(',');

        return [
            'subject' => ['required'],
            'from.email' => ['required', 'email'],
            'from.name' => ['nullable'],
            'to.email' => ['required', 'email'],
            'to.name' => ['nullable'],
            'text' => ['required_without:html'],
            'html' => ['required_without:text'],
            'attachments.*' => [
                'nullable',
                'file',
                'max:10000',
                $mimes,
            ],
        ];
    }

    public function store(): Email
    {
        $data = $this->validated();

        $email = Email::query()->create([
            'user_id' => auth()->id(),
            'subject' => data_get($data, 'subject'),
            'from_email' => data_get($data, 'from.email'),
            'from_name' => data_get($data, 'from.name'),
            'to_email' => data_get($data, 'to.email'),
            'to_name' => data_get($data, 'to.name'),
            'text' => data_get($data, 'text'),
            'html' => data_get($data, 'html'),
            'status' => DeliveryStatus::POSTED,
            'posted_at' => now(),
        ]);

        dispatch(
            fn () => $this->attachFiles($email, $data['attachments'] ?? [])
        )->afterResponse();

        return $email;
    }

    /**
     * @param \App\Models\Email $email
     * @param \Illuminate\Http\UploadedFile[] $files
     */
    private function attachFiles(Email $email, array $files)
    {
        $disk = StorageDisk::ATTACHMENTS->value;

        foreach ($files as $file) {
            $path = $file->store($email->user_id, $disk);

            if (! $path) {
                continue;
            }

            Attachment::create([
                'email_id' => $email->id,
                'original_filename' => $file->getClientOriginalName(),
                'storage_filename' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'disk' => $disk,
            ]);
        }
    }
}
