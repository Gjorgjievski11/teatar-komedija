<?php

namespace App\Jobs;

use App\Models\Play;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\GoogleCalendar\Event;

class CreateGoogleEvent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $date,
        public string $time,
        public Play $play
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $startTime = Carbon::parse($this->date . ' ' . $this->time);

        $endTime = $startTime->copy()->add($this->play->getCarbonDuration());
        $event = Event::create([
            'name' => $this->play->title,
            'startDateTime' => $startTime,
            'endDateTime' => $endTime,
        ]);

        $this->play->assignDate($startTime, $event->id);
    }
}
