<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="d-flex">
                            <h3 class="text-primary mr-2">
                                {{ $group->name }}</h3>
                        </div>
                        <div class="d-flex flex-wrap text-muted">
                            <p class="text-sm mr-4">School
                                <b class="d-block">{{ $group->department->faculty->name }}</b>
                            </p>
                            <p class="text-sm mr-4">Department
                                <b class="d-block">{{ $group->department->name }}</b>
                            </p>
                            <p class="text-sm mr-4">Year
                                <b class="d-block">{{ $group->year->name }}</b>
                            </p>
                            <p class="text-sm mr-4">Semester
                                <b class="d-block">{{ $group->semester->name }}</b>
                            </p>
                            <p class="text-sm">Academic Year
                                <b class="d-block">{{ $group->schoolYear->name }}</b>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total Student</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            {{ $group->users->reject(function ($user) {
                                                    return $user->hasRole('teacher');
                                                })->count() }}
                                        </span>
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
                        <livewire:group.group-subject-table :group="$group" />
                    </div>
                    <div class="col-12 col-md-6">
                        <livewire:group.group-user-table :group="$group" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function() {
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
                        subject_group_id: event.detail.id,
                        teacher_group_id: event.detail.teacher_id
                    })
                    Swal.fire({
                        title: "Removed!",
                        text: "Subject has been removed from the group.",
                        icon: "success"
                    });
                }
            });
        });
        window.addEventListener("alert-user-delete", (event) => {
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
                    Livewire.dispatch('confirmed-user-delete', {
                        user_group_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Removed!",
                        text: "Student has been removed from the group.",
                        icon: "success"
                    });
                }
            });
        });
        window.addEventListener('close-modal', (event) => {
            $('#editGroupSubjectModal-' + event.detail[0].subject_id + '-' + event.detail[0].teacher_id).modal(
                'hide');
        });
    </script>
@endsection
