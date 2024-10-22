<div class="card card-primary">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Department Table</h3>
            <div class="row">
                <div class="col-12">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                        placeholder="Search Department" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>
                        {{-- <x-sort-button :name="'id'" :displayName="'ID'" :sortBy="$sortBy"
                            :sortDir="$sortDir"></x-sort-button> --}}
                        ID
                    </th>
                    <th>
                        {{-- <x-sort-button :name="'name'" :displayName="'Name'" :sortBy="$sortBy"
                            :sortDir="$sortDir"></x-sort-button> --}}
                        Name
                    </th>
                    <th>
                        {{-- <x-sort-button :name="'name'" :displayName="'Name'" :sortBy="$sortBy"
                            :sortDir="$sortDir"></x-sort-button> --}}
                        School
                    </th>
                    <th>
                        {{-- <x-sort-button :name="'created_at'" :displayName="'Created At'" :sortBy="$sortBy"
                            :sortDir="$sortDir"></x-sort-button> --}}
                        Created At
                    </th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr wire:key='{{ $department->id }}'>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->school->name }}</td>
                        <td>{{ $department->created_at }}</td>
                        <td>{{ $department->updated_at }}</td>
                        <td>
                            <div>
                                <a href="{{ route('department.index', $department->id) }}"
                                    class="btn btn-primary">View</a>
                                <button class="btn btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $department->id }}})">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="card-footer clearfix">
        {{ $departments->links() }}
    </div> --}}
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
