<?php

namespace App\Livewire\User;

use App\Models\Document;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Url;

class DocumentsCategory extends Component
{
    #[Url('q')]
    public $category;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $categoryId = match ($this->category) {
            'regulations' => 2,
            'final-account' => 3,
            'public-procurement' => 4,
            default => 1
        };

        $groupedDocuments = Document::searchCategory($categoryId)->get()->groupBy('sub_category_id');
        $groupedDocuments = $groupedDocuments->mapWithKeys(function ($group, $key) {
            $newKey = Document::getSubCategoryName($key);
            return [$newKey => $group];
        });

        return view('livewire.user.documents-category', [
            'groupedDocuments' => $groupedDocuments
        ]);
    }
}
