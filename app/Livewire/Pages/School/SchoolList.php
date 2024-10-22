<?php

namespace App\Livewire\Pages\School;

use App\Models\School;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolList extends Component
{
    use WithPagination;

    #[Url]
    public $pageSize = 10;

    #[On('confirmed-delete')]
    public function delete($school_id)
    {
        $school = School::find($school_id);
        $school->delete();
    }

    public function render()
    {
        return view('livewire.pages.school.school-list', ['schools' => School::paginate($this->pageSize)]);
    }
}
