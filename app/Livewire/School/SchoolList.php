<?php

namespace App\Livewire\School;

use App\Models\School;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolList extends Component
{
    use WithPagination;

    #[Url]
    public $pageSize = 10;

    public function render()
    {
        return view('livewire.school.school-list', ['schools' => School::paginate($this->pageSize)]);
    }
}
