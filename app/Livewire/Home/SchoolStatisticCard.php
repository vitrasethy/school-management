<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class SchoolStatisticCard extends Component
{
    public $school_count;

    public function mount($school_count): void
    {
        $this->school_count = $school_count;
    }

    public function render(): View
    {
        return view('livewire.home.school-statistic-card');
    }
}
