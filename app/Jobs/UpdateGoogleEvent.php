<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\GoogleCalendar\Event;

class UpdateGoogleEvent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $goolgeCalendarId,
        public Carbon $startDate
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $event = Event::find($this->goolgeCalendarId);
        $duration = $event->startDateTime->diff($event->endDateTime);
        $endDate = $this->startDate->copy()->add($duration);
        $event->startDateTime = $this->startDate;
        $event->endDateTime = $endDate;
        $event->save();
    }
}
