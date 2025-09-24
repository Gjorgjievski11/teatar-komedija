<?php

namespace App\Livewire;

use App\Models\JobPosition;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class JobPositionsTable extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.job-positions-table', [
            'positions' => JobPosition::with('employees')->search($this->search)->paginate(4),
        ]);
    }
}
