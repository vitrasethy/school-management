<?php

namespace App\Livewire\Group;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditSubjectModal extends Component
{
    #[Validate('required')]
    public $subject_id = '';

    #[Validate('required')]
    public $user_id = '';

    public Subject $subject;

    public User $teacher;

    public $group;

    public $subjects;

    public $teachers;

    public function mount(Subject $subject, Group $group, User $teacher): void
    {
        $this->subject = $subject;
        $this->teacher = $teacher;
        $this->group = $group;
        $this->subject_id = $subject->id;
        $this->user_id = $teacher->id;
        $this->subjects = Subject::where('department_id', $subject->department_id)->get();
        $this->teachers = User::whereHas('userAffiliations', function ($query) {
            return $query->where('department_id', $this->subject->department_id);
        })->role('teacher')->get();
    }

    public function save(): void
    {
        $this->validate();

        $subjectChanged = $this->subject->id != $this->subject_id;
        $teacherChanged = $this->teacher->id != $this->user_id;

        if (! $subjectChanged && ! $teacherChanged) {
            session()->flash('message', 'Nothing changed');
            session()->flash('alert-type', 'warning');

            return;
        }

        if ($subjectChanged) {
            // Check duplicate subject
            if ($this->group->subjects()->where('subject_id', $this->subject_id)->exists()) {
                session()->flash('message', 'Subject is already added to the group');
                session()->flash('alert-type', 'warning');

                return;
            }
            // Check duplicate teacher
            if ($this->group->users()->where('user_id', $this->user_id)->exists()) {
                session()->flash('message', 'Teacher is already assigned');
                session()->flash('alert-type', 'warning');

                return;
            }
            // Detach the old subject from the group
            $this->group->subjects()->detach($this->subject->id);
            $this->group->users()->detach($this->teacher->id);

            $this->group->subjects()->attach($this->subject_id, ['teacher_id' => $this->user_id]);
            $this->group->users()->attach($this->user_id);
        }

        if ($teacherChanged) {
            // Check duplicate teacher
            if ($this->group->users()->where('user_id', $this->user_id)->exists()) {
                session()->flash('message', 'Teacher is already assigned');
                session()->flash('alert-type', 'warning');

                return;
            }
            // Detach the old subject from the group
            $this->group->subjects()->detach($this->subject->id);
            $this->group->users()->detach($this->teacher->id);

            $this->group->subjects()->attach($this->subject_id, ['teacher_id' => $this->user_id]);
            $this->group->users()->attach($this->user_id);
        }

        session()->flash('message', 'Subject updated successfully');
        session()->flash('alert-type', 'success');
        $this->dispatch('refresh-group-subjects');
        $this->dispatch('refresh-group-users');
        $this->dispatch('close-modal', ['subject_id' => $this->subject->id, 'teacher_id' => $this->teacher->id]);
    }

    public function render(): View
    {
        return view('livewire.group.edit-subject-modal');
    }
}
