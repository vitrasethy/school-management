<?php

namespace App\Livewire\Group;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddSubjectModal extends Component
{
    #[Validate('required')]
    public $subject_id = "";
    #[Validate('required')]
    public $teacher_id = "";
    public $group_id = "";

    public $group;
    public $subjects;
    public $teachers;

    public function mount(Group $group): void
    {
        $this->group = $group;
        $this->group_id = $group->id;
        $this->subjects = Subject::where('department_id', $group->department_id)->get();
        $this->teachers = User::where('department_id', $group->department_id)->role('teacher')->get();
    }

    public function save(): void
    {
        $this->validate();
        $this->group->subjects()->attach($this->subject_id);
        Teacher::query()->create([
            'user_id' => $this->teacher_id,
            'subject_id' => $this->subject_id,
            'group_id' => $this->group_id
        ]);
        $this->reset(['teacher_id', 'subject_id']);
        $this->dispatch('refresh-group-subjects');
    }

    public function render(): View
    {
        return view('livewire.group.add-subject-modal');
    }
}
