<?php

namespace App\Livewire;

use App\Models\Play;
use Livewire\Attributes\Url;
use Livewire\Component;

class PlayGrid extends Component
{
    #[Url('q')]
    public $search;

    public function render()
    {
        $plays = Play::with('dates', 'images', 'crew', 'categories', 'crew.employee.jobPosition')
                ->search($this->search)
                ->orderBy("id", "desc")
                ->paginate(12);
        return view('livewire.play-grid', [
            'plays' => $plays,
        ]);
    }
}
