<?php

namespace App\Livewire;

use App\Models\Contribution;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ContributionsTable extends Component
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
        return view('livewire.contributions-table', [
            'contributions' => Contribution::search($this->search)->paginate(20),
        ]);
    }
}
