<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GroupSubjectTable extends Component
{
    use WithPagination;

    public Group $group;

    public function mount(Group $group): void
    {
        $this->group = $group;
    }

    #[On('refresh-group-subjects')]
    public function refreshGroupSubjects(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($subject_group_id, $teacher_group_id): void
    {
        $this->group->subjects()->detach($subject_group_id);
        $this->group->users()->detach($teacher_group_id);
    }

    public function render(): View
    {
        return view('livewire.group.group-subject-table');
    }
}
