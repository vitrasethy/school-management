<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Students</h3>
            <livewire:group.group-user-add-modal :group="$group"
                                                 :wire:key="'group-modal-'.$group->id"/>

        </div>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Role
                </th>
                <th>
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($group->users as $user)
                <tr wire:key='{{ $user->id }}'>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->getRoleNames()[0] }}</td>
                    <td>
                        <button
                            wire:click="$dispatch('alert-user-delete', {id: {{ $user->id }}})"
                            class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
