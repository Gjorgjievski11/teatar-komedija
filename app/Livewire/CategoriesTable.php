<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesTable extends Component
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
        return view('livewire.categories-table', [
            'categories' => Category::search($this->search)->paginate(20),
        ]);
    }
}
