<?php

namespace App\Livewire\Faculty;

use App\Models\Faculty;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class FacultyTable extends Component
{
    use WithPagination;

    public $per_page = 10;

    #[On('refresh-faculties')]
    public function refreshFaculties(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($faculty_id): void
    {
        $faculty = Faculty::find($faculty_id);
        if ($faculty) {
            $faculty->delete();
            $this->dispatch('delete-success');
        } else {
            $this->dispatch('delete-failure');
        }
    }

    public function render(): View
    {
        return view('livewire.faculty.faculty-table', ['faculties' => Faculty::paginate($this->per_page)]);
    }
}
