<?php

namespace App\Livewire\User;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Play;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;

class ActivitiesCategoryDisplay extends Component
{
    #[Url('q')]
    public $category = 'projects';

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        if ($this->category === 'projects') {
            $activities = Activity::searchByCategory(1)->orderBy('date')->get();
        } else if ($this->category === 'guests') {
            $activities = Activity::searchByCategory(2)->orderBy('date')->get();
        } else if ($this->category === 'promotions') {
            $activities = Activity::searchByCategory(3)->orderBy('date')->get();
        } else {
            $activities = Activity::searchByCategory(4)->orderBy('date')->get();
        }

        return view('livewire.user.activities-category-display', [
            'activities' => $activities,
        ]);
    }
}
