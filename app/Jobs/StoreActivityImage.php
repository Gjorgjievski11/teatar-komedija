<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;
use League\CommonMark\Extension\Footnote\Parser\FootnoteParser;

class StoreActivityImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Activity $activity, public string $tempImgName) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = storage_path('app/private/' . $this->tempImgName);

        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT')
        );

        $uploadFile = $imageKit->upload([
            "file" => fopen($path, 'r'),
            "fileName" => time() . uniqid(),
            "folder" => "/teatar-komedija/activities",
        ]);

        ActivityImage::create([
            'image_kit_id' => $uploadFile->result->fileId,
            'url' => $uploadFile->result->url,
            'activity_id' => $this->activity->id
        ]);


        Storage::disk('local')->delete($this->tempImgName);
    }
}
