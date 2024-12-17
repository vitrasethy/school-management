<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class DepartmentStatisticCard extends Component
{
    public $department_count;

    public function mount($department_count): void
    {
        $this->department_count = $department_count;
    }

    public function render(): View
    {
        return view('livewire.home.department-statistic-card');
    }
}
