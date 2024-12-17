<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GroupUserTable extends Component
{
    use WithPagination;

    public Group $group;

    #[On('refresh-group-users')]
    public function refreshTable(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-user-delete')]
    public function delete($user_group_id): void
    {
        $this->group->users()->detach($user_group_id);
    }

    public function render(): View
    {
        return view('livewire.group.group-user-table');
    }
}
