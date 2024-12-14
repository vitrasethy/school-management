<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Department Table</h3>
            <div class="row">
                <div class="col-12">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                           placeholder="Search Department"/>
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
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($departments as $department)
                <tr wire:key='{{ $department->id }}'>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->school->name }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{-- <a href="{{ route('department.index', $department->id) }}"
                                class="btn btn-sm btn-success">View</a> --}}
                            <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $department->id }}})">Delete
                            </button>
                            <livewire:department.edit-department-modal :department="$department"
                                                                       :wire:key="'department-modal-'.$department->id"/>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $departments->links() }}
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#department>a").addClass("active");
            $("#department").addClass("menu-open");
        });
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
                        department_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "Department has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endsection
