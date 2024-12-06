<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Group Table</h3>
            <div class="row">
                <div class="col-12">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                        placeholder="Search Group" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        School
                    </th>
                    <th>
                        Department
                    </th>
                    <th>
                        Year
                    </th>
                    <th>
                        Academic Year
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    <tr wire:key='{{ $group->id }}'>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            {{ $group->department->school->name }}
                        </td>
                        <td>{{ $group->department->name }}</td>
                        <td>{{ $group->year }}</td>
                        <td>{{ $group->school_year }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                {{-- <a href="{{ route('group.index', $group->id) }}" class="btn btn-sm btn-success">View</a> --}}
                                <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $group->id }}})">Delete</button>
                                <livewire:group.group-edit-modal :group="$group"
                                    :wire:key="'group-modal-'.$group->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $groups->links() }}
    </div>
</div>

@section('js')
    <script>
        // $(document).ready(function() {
        //     $("#sidebar li a").removeClass("active");
        //     $("#schools>a").addClass("active");
        //     $("#schools").addClass("menu-open");
        //     $("#schools-index").addClass("my-active");
        // });
        window.addEventListener("alert-delete", (event) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('confirmed-delete', {
                        group_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "Group has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endsection
