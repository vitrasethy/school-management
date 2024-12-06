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
        if ($user->role_id == 2) {
            $this->school_id = $user->school_id;
        } elseif ($user->role_id == 3) {
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
        return view('livewire.user.user-table', [
            'users' => User::when($this->school_id, function ($query, $school_id) {
                return $query->where('school_id', $school_id);
            })
                ->when($this->department_id, function ($query, $department_id) {
                    return $query->where('department_id', $department_id);
                })
                ->where('role_id', '>', 1)
                ->paginate($this->perPage)
        ]);
    }
}
