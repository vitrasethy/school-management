<?php

namespace App\Livewire\Group;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditSubjectModal extends Component
{
    #[Validate('required')]
    public $subject_id = "";
    #[Validate('required')]
    public $user_id = "";

    public Subject $subject;
    public Teacher $teacher;
    public $group;
    public $subjects;
    public $teachers;

    public function mount(Subject $subject, Group $group, Teacher $teacher): void
    {
        $this->subject = $subject;
        $this->group = $group;
        $this->teacher = $teacher;
        $this->subject_id = $subject->id;
        $this->user_id = $subject->teacher($group->id)->first()->user->id;
        $this->subjects = Subject::where('department_id', $subject->department_id)->get();
        $this->teachers = User::where('department_id', $subject->department_id)->role('teacher')->get();
    }

    public function save(): void
    {
        $this->validate();

        $subjectChanged = $this->subject->id != $this->subject_id;
        $teacherChanged = $this->teacher->user->id != $this->user_id;

        if (!$subjectChanged && !$teacherChanged) {
            session()->flash('message', 'Nothing changed');
            session()->flash('alert-type', 'warning');
            return;
        }


        if ($subjectChanged) {
            // Detach the old subject from the group
            $this->group->subjects()->detach($this->subject->id);

            // Attach the new subject to the group if not already attached
            if (!$this->group->subjects()->where('subject_id', $this->subject_id)->exists()) {
                $this->group->subjects()->attach($this->subject_id);
            }

            // Update the teacher's subject_id
            $this->teacher->update($this->only('subject_id'));
        }

        if ($teacherChanged) {
            $this->teacher->update($this->only('user_id', 'subject_id'));
        }

        session()->flash('message', 'Subject updated successfully');
        session()->flash('alert-type', 'success');
        $this->dispatch('refresh-group-subjects');
    }

    public function render(): View
    {
        return view('livewire.group.edit-subject-modal');
    }
}
