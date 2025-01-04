<?php

namespace App\Livewire\Group;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddSubjectModal extends Component
{
    #[Validate('required')]
    public $subject_id = '';

    #[Validate('required')]
    public $teacher_id = '';

    public $group_id = '';

    public $group;

    public $subjects;

    public $teachers;

    public function mount(Group $group): void
    {
        $this->group = $group;
        $this->group_id = $group->id;
        $this->subjects = Subject::where('department_id', $group->department_id)->get();
        $this->teachers = User::whereHas('userAffiliations', function ($query) {
            $query->where('department_id', $this->group->department_id);
        })->role('teacher')->get();
    }

    public function save(): void
    {
        $this->validate();

        // Check duplicate subject
        if ($this->group->subjects()->where('subject_id', $this->subject_id)->exists()) {
            session()->flash('message', 'Subject is already added to the group');
            session()->flash('alert-type', 'warning');

            return;
        }

        // Check duplicate teacher
        if ($this->group->users()->where('id', $this->teacher_id)->exists()) {
            session()->flash('message', 'Teacher is already assigned');
            session()->flash('alert-type', 'warning');

            return;
        }

        $this->group->subjects()->attach($this->subject_id, ['teacher_id' => $this->teacher_id]);
        $this->group->users()->attach($this->teacher_id);

        $this->reset(['teacher_id', 'subject_id']);
        $this->dispatch('refresh-group-subjects');
        $this->dispatch('refresh-group-users');
    }

    public function render(): View
    {
        return view('livewire.group.add-subject-modal');
    }
}
