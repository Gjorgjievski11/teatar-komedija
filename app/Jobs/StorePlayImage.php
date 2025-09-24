<?php

namespace App\Jobs;

use App\Models\Play;
use App\Models\PlayImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class StorePlayImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Play $play, public string $tempPathName) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT')
        );

        $fullPath = storage_path('app/private/'.$this->tempPathName);
        $fileName = time() . '-' . uniqid();

        $uploadFile = $imageKit->upload([
            "file" => fopen($fullPath, 'r'),
            "fileName" => $fileName,
            "folder" => "/teatar-komedija/plays",
        ]);

        PlayImage::create([
            'image_kit_id' => $uploadFile->result->fileId,
            'path' => $uploadFile->result->url,
            'play_id' => $this->play->id
        ]);

        Storage::disk('local')->delete($this->tempPathName);
    }
}
