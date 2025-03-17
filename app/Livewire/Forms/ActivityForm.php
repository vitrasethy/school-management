<?php

namespace App\Livewire\Forms;

use App\Models\ActivityType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ActivityForm extends Form
{
    public ActivityType $activityType;

    #[Validate('required|min:1')]
    public $name = "";

    public function setForm(ActivityType $activityType)
    {
        $this->activityType = $activityType;
        $this->name = $activityType->name;
    }

    public function create()
    {
        $this->validate();

        $insertData = [
            'name' => $this->name
        ];

        ActivityType::create($insertData);
        $this->reset(['name']);
    }
}
 