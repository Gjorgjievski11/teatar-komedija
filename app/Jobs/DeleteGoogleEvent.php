<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\GoogleCalendar\Event;


class DeleteGoogleEvent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $googleCalendarId
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $event = Event::find($this->googleCalendarId);

        $event->delete();
    }
}
