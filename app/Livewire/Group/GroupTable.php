<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GroupTable extends Component
{
    use WithPagination;

    public $department_id;
    public $school_id;
    public $perPage = 10;

    public function mount()
    {
        $user = Auth::user();
        if ($user->role_id == 2) {
            $this->school_id = $user->school_id;
        }
        if ($user->role_id == 3) {
            $this->department_id = $user->department_id;
        }
    }

    #[On('refresh-groups')]
    public function refreshgroups()
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($group_id)
    {
        $group = Group::find($group_id);
        $group->delete();
    }

    public function render()
    {
        return view('livewire.group.group-table', [
            'groups' => Group::when($this->department_id, function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            })
                ->when($this->school_id, function ($query, $school_id) {
                    return $query->whereHas('department', function ($query) use ($school_id) {
                        $query->where('school_id', $school_id);
                    });
                })
                ->paginate($this->perPage)
        ]);
    }
}
