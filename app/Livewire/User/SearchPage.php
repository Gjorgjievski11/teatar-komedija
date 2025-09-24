<?php

namespace App\Livewire\User;

use App\Models\Play;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPage extends Component
{
    use WithPagination;

    #[Url('q')]
    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $plays = Play::with('dates')->search($this->search)->paginate(3);
        return view('livewire.user.search-page', [
            'plays' => $plays
        ]);
    }
}
