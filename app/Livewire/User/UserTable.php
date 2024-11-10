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
        if ($user->role_id == 1) {
            $this->school_id = $user->school_id;
        } elseif ($user->role_id == 2) {
            $this->department_id = $user->departments->first()->id;
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
        $user->departments()->detach();
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
                    return $query->whereHas('departments', function ($query) use ($department_id) {
                        $query->where('departments.id', $department_id);
                    });
                })
                ->where('is_super_admin', false)
                ->paginate($this->perPage)
        ]);
    }
}
