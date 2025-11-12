<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesDisplay extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public $search;

    public $sort = 'asc'; // default A-Z

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function toggleSort()
    {
        $this->sort = $this->sort === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        return view('livewire.employees-display', [
            'employees' => Employee::with(['images', 'jobPosition'])
                ->search($this->search)
                ->orderBy('name', $this->sort)
                ->orderBy('surname', $this->sort)
                ->paginate(20),
        ]);
    }
}
