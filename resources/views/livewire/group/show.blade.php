<div class="card card-primary">
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
                        Year
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
                @foreach ($groups as $school)
                    <tr wire:key='{{ $school->id }}'>
                        <td>{{ $school->id }}</td>
                        <td>{{ $school->name }}</td>
                        <td>{{ $school->school_year }}</td>
                        <td>{{ $school->created_at }}</td>
                        <td>{{ $school->updated_at }}</td>
                        <td>
                            <a href="{{ route('group.index', $school->id) }}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="card-footer clearfix">
        {{ $schools->links() }}
    </div> --}}
</div>
