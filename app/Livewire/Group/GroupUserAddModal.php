<?php

namespace App\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class GroupUserAddModal extends Component
{
    public $group;

    public $search_term;

    public $students = [];

    public function mount(Group $group): void
    {
        $this->group = $group;
    }

    public function updatedSearchTerm(): void
    {
        if (empty($this->search_term)) {
            $this->students = [];

            return;
        }

        $query = User::query();

        $this->students = $query->where('name', 'like', '%'.$this->search_term.'%')
            ->role('student')
            ->whereDoesntHave('groups', function ($query) {
                $query->where('group_id', $this->group->id);
            })
            ->whereHas('userAffiliations', function ($query) {
                return $query->where('department_id', $this->group->department_id);
            })
            ->get();
    }

    public function addStudent($student_id): void
    {
        $student = User::find($student_id);
        $student->groups()->attach($this->group->id);
        $this->dispatch('refresh-group-users');
    }

    public function render(): View
    {
        return view('livewire.group.group-user-add-modal');
    }
}
