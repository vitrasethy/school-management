<?php

namespace App\Livewire\Student;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class StudentTable extends Component
{
    use WithPagination;

    public $school_id;

    public $department_id;

    public $per_page = 10;

    public function mount()
    {
        $user = Auth::user();
        if ($user->role_id == 2) {
            $this->school_id = $user->school_id;
        } elseif ($user->role_id == 3) {
            $this->department_id = $user->department_id;
        }
    }

    #[On('refresh-students')]
    public function refreshStudents()
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($student_id)
    {
        $student = User::find($student_id);
        $student->groups()->detach();
        $student->delete();
    }

    public function render()
    {
        $query = User::query();

        if ($this->school_id) {
            $query->when($this->school_id, function ($query, $school_id) {
                return $query->where('school_id', $school_id);
            });
        }

        if ($this->department_id) {
            $query->when($this->department_id, function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            });
        }

        return view('livewire.student.student-table', ['students' => $query->where('role_id', 4)->paginate($this->per_page)]);
    }
}
