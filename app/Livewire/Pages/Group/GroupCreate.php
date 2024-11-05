<?php

namespace App\Livewire\Pages\Group;

use App\Livewire\Forms\GroupForm;
use App\Models\School;
use Livewire\Component;

class GroupCreate extends Component
{
    public GroupForm $form;
    public $school_id = 0;

    public function save() {}

    public function render()
    {
        return view('livewire.pages.group.group-create', ['schools' => School::all()]);
    }
}
