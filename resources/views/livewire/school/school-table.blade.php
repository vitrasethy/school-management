<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">School List</h3>
            <div class="row">
                <div class="col-4">
                    <select wire:model.live='perPage' class="form-control mr-2" aria-label="Default select example">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div class="col-8">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                           placeholder="Search School"/>
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
                    Created At
                </th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($schools as $school)
                <tr wire:key='{{ $school->id }}'>
                    <td>{{ $school->id }}</td>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->created_at }}</td>
                    <td>{{ $school->updated_at }}</td>
                    <td>
                        <div class="d-flex">
                            {{-- <a href="{{ route('super.school.index', $school->id) }}"
                                class="btn btn-sm btn-success">View</a> --}}
                            <livewire:school.school-edit-modal :school="$school" :wire:key="$school->id"/>
                            <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $school->id }}})">Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $schools->links() }}
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#school>a").addClass("active");
            $("#school").addClass("menu-open");
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
                        school_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "School has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endsection
