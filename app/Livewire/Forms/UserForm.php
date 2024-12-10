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
    // #[Validate('required')]
    public $school_id = null;
    // #[Validate('required')]
    public $department_id = null;
    // #[Validate('required')]
    public $group_id = 0;
    public $group_id_list = [];
    #[Validate('required')]
    public $role = "";

    public function setForm(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->school_id = $user->school_id;
        $this->department_id = $user->department_id;
        $this->group_id = $user->groups->isNotEmpty() ? $user->groups[0]->id : null;
        $this->group_id_list = $user->groups->pluck('id')->toArray();
        $this->role = $user->getRoleNames()[0];
    }

    public function create()
    {
        $this->validate();
        $user = User::create([
            'school_id' => $this->school_id == 0 ? null : $this->school_id,
            'department_id' => $this->department_id == 0 ? null : $this->department_id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $user->assignRole($this->role);
        if (!empty($this->group_id_list)) {
            $user->groups()->attach($this->group_id_list);
        }

        $this->reset(['name', 'email', 'password', 'group_id_list', 'role']);
    }

    public function update()
    {
        $this->validate();
        $updateData = $this->only(['name', 'email', 'school_id', 'department_id']);

        // Only update the password if it is provided
        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $this->user->update($updateData);
        $this->user->syncRoles($this->role);

        if ($this->role == "super admin" || $this->role == "school admin" || $this->role == "department admin") {
            $this->user->groups()->detach();
        } else {
            // Update the related groups
            if (!empty($this->group_id_list)) {
                $this->user->groups()->sync($this->group_id_list);
            } else {
                $this->user->groups()->detach();
            }
        }
    }
}
