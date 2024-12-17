<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class GroupStatisticCard extends Component
{
    public $group_count;

    public function mount($group_count): void
    {
        $this->group_count = $group_count;
    }

    public function render(): View
    {
        return view('livewire.home.group-statistic-card');
    }
}
