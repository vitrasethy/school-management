<?php

namespace App\Livewire\School;

use App\Models\School;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolTable extends Component
{
    use WithPagination;

    public $perPage;

    #[On('refresh-schools')]
    public function refreshSchools(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($school_id): void
    {
        $school = School::find($school_id);
        $school->delete();
    }

    public function render(): View
    {
        return view('livewire.school.school-table', ['schools' => School::paginate($this->perPage)]);
    }
}
