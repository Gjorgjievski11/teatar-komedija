<?php

namespace App\Livewire;

use App\Exports\NewsletterExport;
use App\Models\Newsletter;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class NewslettersTable extends Component
{
    use WithPagination;

    #[Url('q', true)]
    public $search;

    public $format;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function download()
    {
        if (!$this->format) {
            return;
        }

        if (!in_array($this->format, ['xlsx', 'csv'])) {
            return;
        }

        $writerType = match ($this->format) {
            'xlsx' => \Maatwebsite\Excel\Excel::XLSX,
            'csv' =>  \Maatwebsite\Excel\Excel::CSV
        };

        return Excel::download(new NewsletterExport, time() . '-newsletter.' . $this->format, $writerType);
    }


    public function render()
    {
        $newsletters = Newsletter::search($this->search)->orderBy('created_at', "DESC")->paginate(20);

        return view('livewire.newsletters-table', [
            'newsletters' => $newsletters,
        ]);
    }
}
