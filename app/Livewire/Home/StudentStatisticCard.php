<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class StudentStatisticCard extends Component
{
    public $student_count;

    public function render(): View
    {
        return view('livewire.home.student-statistic-card');
    }
}
