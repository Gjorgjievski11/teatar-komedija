<?php

namespace App\Livewire;

use App\Models\Contribution;
use App\Models\Employee;
use App\Models\JobPosition;
use App\Models\Play;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CrewSearch extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Url('q', true)]
    public $search;
    public $searchFor; // the select element that will search by job
    public $crew = [];
    public $playCrew;
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount(Play $play)
    {
        $this->playCrew = $play->crew;
        // dd($this->playCrewpџ);
    }

    public function render()
    {
        $employees =  Employee::with('jobPosition')
            ->whereNotIn('id', $this->playCrew->pluck('employee_id')->toArray())
            ->searchPosition($this->searchFor)
            ->search($this->search)
            ->orderBy('name')
            ->paginate(32);

        return view('livewire.crew-search', [
            'employees' => $employees,
            'contributions' => Contribution::all(),
            'positions' => JobPosition::all(),
        ]);
    }
}
