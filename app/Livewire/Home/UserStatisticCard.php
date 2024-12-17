<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class UserStatisticCard extends Component
{
    public $user_count;

    public function mount($user_count): void
    {
        $this->user_count = $user_count;
    }

    public function render(): View
    {
        return view('livewire.home.user-statistic-card');
    }
}
