<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Faculty List</h3>
            <div class="row">
                <div class="col-4">
                    <select wire:model.live='per_page' class="form-control mr-2" aria-label="Default select example">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div class="col-8">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                           placeholder="Search Faculty"/>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($faculties as $faculty)
                <tr wire:key='{{ $faculty->id }}'>
                    <td><img src="{{ $faculty->image_url ?? asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}"
                             class="img-circle brand-image mr-2" style="width: 30px; height: 30px; object-fit: cover;"
                             alt="school-logo"/> {{ $faculty->name }}</td>
                    <td>
                        <div class="d-flex">
                            {{-- <a href="{{ route('super.school.index', $faculty->id) }}"
                                class="btn btn-sm btn-success">View</a> --}}
                            <livewire:faculty.faculty-edit-modal :faculty="$faculty" :wire:key="$faculty->id"/>
                            <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $faculty->id }}})"><i
                                    class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $faculties->links() }}
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
                        faculty_id: event.detail.id
                    });
                }
            });
        });
        window.addEventListener("delete-success", () => {
            Swal.fire({
                title: "Deleted!",
                text: "Faculty has been deleted.",
                icon: "success"
            });
        });
        window.addEventListener("delete-failure", () => {
            Swal.fire({
                title: "Error!",
                text: "Failed to delete faculty.",
                icon: "error"
            });
        });
    </script>
@endsection
