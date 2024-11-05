<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentForm extends Form
{
    public User $user;

    #[Validate('required|min:1')]
    public $name = "";
    #[Validate('required|min:1')]
    public $email = "";
    #[Validate('required|min:1')]
    public $password = "";

    public function setGroupId(User $user) {
        $this
    }
}
