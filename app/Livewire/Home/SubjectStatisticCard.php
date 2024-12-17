<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class SubjectStatisticCard extends Component
{
    public $subject_count;

    public function mount($subject_count): void
    {
        $this->subject_count = $subject_count;
    }

    public function render(): View
    {
        return view('livewire.home.subject-statistic-card');
    }
}
