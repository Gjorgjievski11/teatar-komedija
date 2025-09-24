<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentsDisplay extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $documents = Document::search($this->search)->paginate(20);
        $documents->each(function ($document) {
            $document->category_name = Document::getCategoryName($document->category_id);
            $document->sub_category_name = Document::getSubCategoryName($document->sub_category_id);
        });

        return view('livewire.documents-display', [
            'documents' => $documents
        ]);
    }
}
