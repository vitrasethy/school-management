<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Student Table</h3>
            <div class="row">
                <div class="col-12">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                        placeholder="Search User" />
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
                        School
                    </th>
                    <th>
                        Department
                    </th>
                    <th>
                        Role
                    </th>
                    {{-- <th>
                        Created At
                    </th>
                    <th>Updated At</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr wire:key='{{ $student->id }}'>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            {{ $student->school->name }}
                        </td>
                        <td>
                            {{ $student->department ? $student->department->name : 'N/A' }}
                        </td>
                        <td>{{ $student->role->name }}</td>
                        {{-- <td>{{ $student->created_at }}</td>
                        <td>{{ $student->updated_at }}</td> --}}
                        <td>
                            <div class="d-flex align-items-center">
                                {{-- <a href="{{ route('student.index', $student->id) }}" class="btn btn-sm btn-success">View</a> --}}
                                <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $student->id }}})">Delete</button>
                                <livewire:student.student-edit-modal :student="$student"
                                    :wire:key="'student-modal-'.$student->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $students->links() }}
    </div>
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
                        student_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "Student has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endsection
