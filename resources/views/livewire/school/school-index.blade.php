<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $school->name }}</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Departments</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Teachers</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Students</b> <a class="float-right">13,287</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                    <p class="text-muted">Malibu, California</p>
                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                    <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                    </p>
                    <hr>
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                        neque.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <livewire:department.department-create :school="$school" />
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
                            {{-- <x-sort-button :name="'created_at'" :displayName="'Created At'" :sortBy="$sortBy"
                                :sortDir="$sortDir"></x-sort-button> --}}
                            Created At
                        </th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $school)
                        <tr wire:key='{{ $school->id }}'>
                            <td>{{ $school->id }}</td>
                            <td>{{ $school->name }}</td>
                            <td>{{ $school->created_at }}</td>
                            <td>{{ $school->updated_at }}</td>
                            <td>
                                <a href="{{ route('department.index', $school->id) }}" class="btn btn-primary">View</a>
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
</div>
