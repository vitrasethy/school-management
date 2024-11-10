<?php

namespace App\Livewire\School;

use App\Models\School;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolTable extends Component
{
    use WithPagination;

    public $perPage;

    #[On('refresh-schools')]
    public function refreshSchools()
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($school_id)
    {
        $school = School::find($school_id);
        $school->delete();
    }

    public function render()
    {
        return view('livewire.school.school-table', ['schools' => School::paginate($this->perPage)]);
    }
}
