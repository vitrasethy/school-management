<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="d-flex">
                            <h3 class="text-primary mr-2">
                                {{ $group->department->abbr }}
                                {{ $group->name }}</h3>
                        </div>
                        <div class="d-flex flex-wrap text-muted">
                            <p class="text-sm mr-4">School
                                <b class="d-block">{{ $group->department->school->name }}</b>
                            </p>
                            <p class="text-sm mr-4">Department
                                <b class="d-block">{{ $group->department->name }}</b>
                            </p>
                            <p class="text-sm mr-4">Year
                                <b class="d-block">{{ $group->year }}</b>
                            </p>
                            <p class="text-sm">Academic Year
                                <b class="d-block">{{ $group->school_year }}</b>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total Student</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $group->users->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total Subject</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $group->subjects->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <livewire:group.group-subject-table :group="$group"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Students</h3>
                                    <livewire:group.add-student-modal :group="$group"
                                                                      :wire:key="'group-modal-'.$group->id"/>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($group->users as $user)
                                        <tr wire:key='{{ $user->id }}'>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->getRoleNames()[0] }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#group>a").addClass("active");
            $("#group").addClass("menu-open");
        });
    </script>
@endsection


