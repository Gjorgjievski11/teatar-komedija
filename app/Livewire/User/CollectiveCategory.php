<?php

namespace App\Livewire\User;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Url;


class CollectiveCategory extends Component
{

    #[Url('q')]
    public $category;

    public function setCategory($category){
        $this->category = $category;
    }
    public function render()
    {
        $getData = collect([]);
        if ($this->category === 'director') {
            $getData = Employee::with('images', 'jobPosition')
                ->whereHas('jobPosition', function ($q) {
                    $q->where('job_category', 'director');
                })->get();
        } elseif ($this->category === 'art_sector' || $this->category === 'artistic') {
            $getData = Employee::with('images', 'jobPosition')
                ->whereHas('jobPosition', function ($q) {
                    $q->where('job_category', 'artistic');
                })->get();
        } elseif ($this->category === 'administration' || $this->category === 'administrative') {
            $getData = Employee::with('images', 'jobPosition')
                ->whereHas('jobPosition', function ($q) {
                    $q->where('job_category', 'administrative');
                })->get();
        } elseif ($this->category === 'technical_sector' || $this->category === 'technical') {
            $getData = Employee::with('images', 'jobPosition')
                ->whereHas('jobPosition', function ($q) {
                    $q->where('job_category', 'technical');
                })->get();
        }
        return view('livewire.user.collective-category', ["getData" => $getData]);
    }
}
