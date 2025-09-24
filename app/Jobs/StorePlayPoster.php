<?php

namespace App\Jobs;

use App\Models\Play;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class StorePlayPoster implements ShouldQueue
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

        if (isset($uploadFile->result) && isset($uploadFile->result->url)) {    
            $this->play->poster = $uploadFile->result->url;
            $this->play->image_kit_id = $uploadFile->result->fileId;
            $this->play->save();
        }


        Storage::disk('local')->delete($this->tempPathName);
    }
}
