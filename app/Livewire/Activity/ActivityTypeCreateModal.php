<?php

namespace App\Livewire\Activity;

use App\Livewire\Forms\ActivityForm;
use Livewire\Component;

class ActivityTypeCreateModal extends Component
{
    public ActivityForm $form;

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-activity-types');
    }

    public function render()
    {
        return view('livewire.activity.activity-type-create-modal');
    }
}
