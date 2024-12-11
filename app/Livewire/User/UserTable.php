<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $school_id;
    public $department_id;
    public $perPage = 10;

    public function mount()
    {
        $user = Auth::user();
        if ($user->getRoleNames()->contains('school admin')) {
            $this->school_id = $user->school_id;
        } elseif ($user->getRoleNames()->contains('department admin')) {
            $this->department_id = $user->department_id;
        }
    }

    #[On('refresh-users')]
    public function refreshUsers()
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($user_id)
    {
        $user = User::find($user_id);
        $user->groups()->detach();
        $user->delete();
    }

    public function render()
    {
        $query = User::query();

        if ($this->school_id) {
            $query->when($this->school_id, function ($query) {
                return $query->where('school_id', $this->school_id);
            });
        }

        if ($this->department_id) {
            $query->when($this->department_id, function ($query) {
                return $query->where('department_id', $this->department_id);
            });
        }

        return view('livewire.user.user-table', [
            'users' => $query->withoutRole('super admin')->paginate($this->perPage)
        ]);
    }
}
