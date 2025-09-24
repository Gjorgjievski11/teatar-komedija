<?php

namespace App\Jobs;

use App\Models\Document;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class StoreDocument implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Document $document, public string $tmepFilePath) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = storage_path('app/private/' . $this->tmepFilePath);
        // Log::info('path', [$path]);
        $imageKit = new ImageKit(env('IMAGE_KIT_PUBLIC_KEY'), env('IMAGE_KIT_PRIVATE_KEY'), env('IMAGE_KIT_URL_END_POINT'));

        $uploadFile = $imageKit->upload([
            'file' => fopen($path, 'r'),
            'fileName' => time() . '-' . uniqid(),
            'folder' => '/teatar-komedija/documents',
        ]);

            $this->document->url = $uploadFile->result->url;
            $this->document->image_kit_id = $uploadFile->result->fileId;
            $this->document->save();
        

        Storage::disk('local')->delete($this->tmepFilePath);
    }
}
