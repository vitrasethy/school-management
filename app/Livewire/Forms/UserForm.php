<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public User $user;

    #[Validate('required')]
    public $name = "";
    #[Validate('required')]
    public $email = "";
    #[Validate('nullable|string|min:8')]
    public $password = "";
    #[Validate('required')]
    public $school_id = 0;
    // #[Validate('required')]
    public $department_id = 0;
    // #[Validate('required')]
    public $group_id = 0;
    public $group_id_list = [];
    #[Validate('required')]
    public $role_id = 0;

    public function setForm(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->school_id = $user->school_id;
        $this->department_id = $user->departments->isNotEmpty() ? $user->departments[0]->id : null;
        $this->group_id = $user->groups->isNotEmpty() ? $user->groups[0]->id : null;
        $this->group_id_list = $user->groups->pluck('id')->toArray();
        $this->role_id = $user->role_id;
    }

    public function create()
    {
        $this->validate();
        $user = User::create([
            'role_id' => $this->role_id,
            'school_id' => $this->school_id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_super_admin' => false,
        ]);

        if ($this->department_id) {
            $user->departments()->attach($this->department_id);
        } elseif (($this->role_id == 3 || $this->role_id == 4) && $this->group_id) {
            $user->groups()->attach($this->group_id);
        }

        $this->reset(['name', 'email', 'password', 'department_id', 'group_id', 'role_id']);
    }

    public function update()
    {
        $this->validate();
        $updateData = $this->only(['name', 'email', 'role_id']);

        // Only update the password if it is provided
        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $this->user->update($updateData);

        // Update the related departments
        if ($this->department_id) {
            $this->user->departments()->sync([$this->department_id]);
        } else {
            $this->user->departments()->detach();
        }

        // Update the related groups
        if (!empty($this->group_id_list)) {
            $this->user->groups()->sync($this->group_id_list);
        } else {
            $this->user->groups()->detach();
        }
    }
}
