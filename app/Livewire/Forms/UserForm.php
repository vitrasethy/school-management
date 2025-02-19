<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public User $user;

    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $email = '';

    #[Validate('nullable|string|min:8')]
    public $password = '';

    // #[Validate('required')]
    public $faculty_id = null;

    // #[Validate('required')]
    public $department_id = null;

    // #[Validate('required')]
    public $group_id = 0;

    public $group_id_list = [];

    #[Validate('required')]
    public $role = '';

    public $image_url = null;

    public $existing_image = '';

    public function setForm(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->faculty_id = $user->userAffiliations()->first()->faculty_id;
        $this->department_id = $user->userAffiliations()->first()->department_id ?? null;
        $this->group_id = $user->groups->isNotEmpty() ? $user->groups[0]->id : null;
        $this->group_id_list = $user->groups->pluck('id')->toArray();
        $this->role = $user->getRoleNames()[0];
        $this->existing_image = $user->image_url;
    }

    public function create(): void
    {
        $this->validate();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
        if ($this->image_url) {
            $path = $this->image_url->store('users', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $user = User::create($data);
        $user->assignRole($this->role);
        $user->userAffiliations()->create([
            'faculty_id' => $this->faculty_id == 0 ? null : $this->faculty_id,
            'department_id' => $this->department_id == 0 ? null : $this->department_id,
        ]);
        if (! empty($this->group_id_list)) {
            $user->groups()->attach($this->group_id_list);
        }

        $this->reset(['name', 'email', 'password', 'group_id_list', 'role', 'image_url']);
    }

    public function update(): void
    {
        $this->validate();
        $updateData = $this->only(['name', 'email']);

        // Only update the password if it is provided
        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }
        // Only update the profile img if it is a provided
        if ($this->image_url) {
            if ($this->existing_image) {
                $oldPath = str_replace('/storage/', '', $this->existing_image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            // Store new image and get URL
            $path = $this->image->store('users', 'public');
            $updateData['image_url'] = Storage::url($path);
        }

        $this->user->update($updateData);
        $this->existing_image = $data['image_url'] ?? $this->existing_image;
        $this->user->syncRoles($this->role);
        $this->user->userAffiliations()->update([
            'faculty_id' => $this->faculty_id == 0 ? null : $this->faculty_id,
            'department_id' => $this->department_id == 0 ? null : $this->department_id,
        ]);

        if ($this->role == 'super admin' || $this->role == 'school admin' || $this->role == 'department admin') {
            $this->user->groups()->detach();
        } else {
            // Update the related groups
            if (! empty($this->group_id_list)) {
                $this->user->groups()->sync($this->group_id_list);
            } else {
                $this->user->groups()->detach();
            }
        }
    }
}
