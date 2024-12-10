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

        if ($user->hasRole('school admin')) {
            $this->school_id = $user->school_id;
        }
        if ($user->hasRole('department admin')) {
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
        $query = Group::query();

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        if ($this->school_id) {
            $query->whereHas('department', function ($query) {
                return $query->where('school_id', $this->school_id);
            });
        }

        return view('livewire.group.group-table', [
            'groups' => $query->paginate($this->perPage)
        ]);
    }
}
