<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class TeacherStatisticCard extends Component
{
    public $teacher_count;

    public function mount($teacher_count): void
    {
        $this->teacher_count = $teacher_count;
    }

    public function render(): View
    {
        return view('livewire.home.teacher-statistic-card');
    }
}
