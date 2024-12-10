<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectTable extends Component
{
    use WithPagination;

    public $school_id;
    public $department_id;
    public $per_page = 10;

    public function mount()
    {
        $user = Auth::user();

        if ($user->hasRole('school admin')) {
            $this->school_id = $user->school_id;
        } elseif ($user->hasRole('department admin')) {
            $this->department_id = $user->department_id;
        }
    }

    #[On('refresh-subjects')]
    public function refreshSubjects()
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($subject_id)
    {
        $subject = Subject::find($subject_id);
        $subject->delete();
    }

    public function render()
    {
        $query = Subject::query();

        if ($this->school_id) {
            $query->whereHas('department', function ($query) {
                $query->where('school_id', $this->school_id);
            });
        }

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        return view('livewire.subject.subject-table', [
            'subjects' => $query->paginate($this->per_page)
        ]);
    }
}
