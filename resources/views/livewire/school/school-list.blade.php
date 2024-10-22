<div class="card card-primary">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Themes Table</h3>
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
                        placeholder="Search Themes" />
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
                    </th>
                    <th>
                        {{-- <x-sort-button :name="'name'" :displayName="'Name'" :sortBy="$sortBy"
                            :sortDir="$sortDir"></x-sort-button> --}}
                    </th>
                    <th>
                        {{-- <x-sort-button :name="'created_at'" :displayName="'Created At'" :sortBy="$sortBy"
                            :sortDir="$sortDir"></x-sort-button> --}}
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
                            <a href="{{ route('school.index', $school->id) }}" class="btn btn-primary">View</a>
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
        $(document).ready(function() {
            $("#sidebar li a").removeClass("active");
            $("#schools>a").addClass("active");
            $("#schools").addClass("menu-open");
            $("#schools-index").addClass("my-active");
        });
        // window.addEventListener("alert-delete", (event) => {
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes, delete it!"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Livewire.dispatch('confirmed-delete', {
        //                 themeId: event.detail.id
        //             })
        //             Swal.fire({
        //                 title: "Deleted!",
        //                 text: "Your theme has been deleted.",
        //                 icon: "success"
        //             });
        //         }
        //     });
        // });
    </script>
@endsection
