<div class="card">
    <div class="card-header">
        @if($filters['faculty_id'] || $filters['department_id'] || $filters['year'] || $filters['academic_year'])
            <div class="mb-2">Applied Filters:
                @if($filters['faculty_id'])
                    <span wire:key="filter-pill-gender"
                          class="badge badge-pill badge-info d-inline-flex align-items-center">
                                Faculty: {{$faculty->abbr}}
                    <a href="#" wire:click.prevent="removeFilter('faculty')" class="text-white ml-2">
                        <span class="sr-only">Remove filter option</span>
                        <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none"
                             viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5"
                                  d="M1 1l6 6m0-6L1 7"></path>
                        </svg>
                    </a>
                </span>
                @endif
                @if($filters['department_id'])
                    <span wire:key="filter-pill-gender"
                          class="badge badge-pill badge-info d-inline-flex align-items-center">
                                Department: {{$department->abbr}}
                    <a href="#" wire:click.prevent="removeFilter('department')" class="text-white ml-2">
                        <span class="sr-only">Remove filter option</span>
                        <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none"
                             viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5"
                                  d="M1 1l6 6m0-6L1 7"></path>
                        </svg>
                    </a>
                </span>
                @endif
                @if($filters['year'])
                    <span wire:key="filter-pill-gender"
                          class="badge badge-pill badge-info d-inline-flex align-items-center">
                                Year: {{$filters['year']}}
                    <a href="#" wire:click.prevent="removeFilter('year')" class="text-white ml-2">
                        <span class="sr-only">Remove filter option</span>
                        <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none"
                             viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5"
                                  d="M1 1l6 6m0-6L1 7"></path>
                        </svg>
                    </a>
                </span>
                @endif
                @if($filters['academic_year'])
                    <span wire:key="filter-pill-gender"
                          class="badge badge-pill badge-info d-inline-flex align-items-center">
                                Academic Year: {{$filters['academic_year']}}
                    <a href="#" wire:click.prevent="removeFilter('academic_year')" class="text-white ml-2">
                        <span class="sr-only">Remove filter option</span>
                        <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none"
                             viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5"
                                  d="M1 1l6 6m0-6L1 7"></path>
                        </svg>
                    </a>
                </span>
                @endif
                <a href="#" wire:click.prevent="resetFilters" class="badge badge-pill badge-light">Clear</a>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                       placeholder="Search User"/>
                <div x-data="{ open: false }" x-on:keydown.escape.stop="open = false" x-on:mousedown.away="open = false"
                     class="btn-group d-block d-md-inline">
                    <button x-on:click="open = !open" type="button"
                            class="btn dropdown-toggle d-block w-100 d-md-inline">
                        Filters
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu w-100" x-bind:class="{'show' : open }" role="menu">
                        @role('super admin')
                        <li>
                            <div wire:key="filter-school" class="p-2">
                                <label for="filter-school" class="mb-2">
                                    Faculty
                                </label>
                                <select wire:model.live="filters.faculty_id"
                                        id="filter-faculty" class="form-control">
                                    <option value="">Any</option>
                                    @foreach($faculties as $faculty)
                                        <option wire:key="{{$faculty->id}}"
                                                value={{$faculty->id}}>{{$faculty->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        @endrole
                        @role(['super admin', 'school admin'])
                        <li>
                            <div wire:key="filter-department" class="p-2">
                                <label for="filter-department" class="mb-2">
                                    Department
                                </label>
                                <select wire:model.live="filters.department_id"
                                        id="filter-department" class="form-control">
                                    <option value="">Any</option>
                                    @foreach($departments as $department)
                                        <option wire:key="{{$department->id}}"
                                                value={{$department->id}}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        @endrole
                        <li>
                            <div wire:key="filter-year" class="p-2">
                                <label for="filter-year" class="mb-2">
                                    Year
                                </label>
                                <select wire:model.live="filters.year"
                                        id="filter-year" class="form-control">
                                    <option value="">Any</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div wire:key="filter-academic-year" class="p-2">
                                <label for="filter-academic-year" class="mb-2">
                                    Academic Year
                                </label>
                                <select wire:model.live="filters.academic_year"
                                        id="filter-academic-year" class="form-control">
                                    <option value="">Any</option>
                                    <option value="2025-2026">2025-2026</option>
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2023-2024">2023-2024</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
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
                        {{ $group->department->faculty->name }}
                    </td>
                    <td>{{ $group->department->name }}</td>
                    <td>{{ $group->year }}</td>
                    <td>{{ $group->school_year }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('group.show', $group->id) }}" class="btn btn-sm btn-primary mr-2"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            {{--                            <livewire:group.group-edit-modal :group="$group"--}}
                            {{--                                                             :wire:key="'group-modal-'.$group->id"/>--}}
                            <button class="btn btn-sm btn-danger ml-2"
                                    wire:click="$dispatch('alert-delete', {id: {{ $group->id }}})"><i
                                    class="fa fa-trash"
                                    aria-hidden="true"></i>
                            </button>
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
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#group>a").addClass("active");
            $("#group").addClass("menu-open");
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
