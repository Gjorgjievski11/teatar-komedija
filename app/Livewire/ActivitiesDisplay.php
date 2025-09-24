<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Attributes\Url;
use Livewire\Component;

class ActivitiesDisplay extends Component
{
    #[Url('q', true)]
    public $search;

    #[Url('r', true)]
    public $category;

    public function render()
    {
        $activites = Activity::searchBy($this->search)
            ->searchByCategory($this->category)
            ->orderBy('created_at')
            ->get();

        return view('livewire.activities-display', [
            'activities' => $activites
        ]);
    }
}
