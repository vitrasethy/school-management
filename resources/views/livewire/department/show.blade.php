<div class="card">
    <div class="card-header">
        @if($school_id && Auth::user()->hasRole('super admin'))
            <div class="mb-2">Applied Filters:
                <span wire:key="filter-pill-gender"
                      class="badge badge-pill badge-info d-inline-flex align-items-center">
                        School: {{$school->abbr}}
                    </span>
                <a href="#" wire:click.prevent="resetFilter" class="badge badge-pill badge-light">Clear</a>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                       placeholder="Search Department"/>
                @role('super admin')
                <div x-data="{ open: false }" x-on:keydown.escape.stop="open = false" x-on:mousedown.away="open = false"
                     class="btn-group d-block d-md-inline">
                    <button x-on:click="open = !open" type="button"
                            class="btn dropdown-toggle d-block w-100 d-md-inline">
                        Filters
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu w-100" x-bind:class="{'show' : open }" role="menu">
                        <li>
                            <div wire:key="filter-school" class="p-2">
                                <label for="filter-school" class="mb-2">
                                    School
                                </label>
                                <select wire:model.live="school_id"
                                        id="filter-school" class="form-control">
                                    <option value="">Any</option>
                                    @foreach($schools as $school)
                                        <option wire:key="{{$school->id}}"
                                                value={{$school->id}}>{{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
                @endrole
            </div>
            <div>
                <select wire:model.live='perPage' class="form-control mr-2" aria-label="Default select example">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
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
                            <livewire:department.edit-department-modal :department="$department"
                                                                       :wire:key="'department-modal-'.$department->id"/>
                            <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $department->id }}})"><i
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
