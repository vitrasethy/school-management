<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Subject Table</h3>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr wire:key='{{ $subject->id }}'>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            {{ $subject->department->school->name }}
                        </td>
                        <td>
                            {{ $subject->department->name }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                {{-- <a href="{{ route('subject.index', $subject->id) }}"
                                    class="btn btn-sm btn-success">View</a> --}}
                                <button class="btn btn-sm btn-danger"
                                    wire:click="$dispatch('alert-delete', {id: {{ $subject->id }}})">Delete</button>
                                <livewire:subject.subject-edit-modal :subject="$subject"
                                    :wire:key="'subject-modal-'.$subject->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $subjects->links() }}
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
                        subject_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "Subject has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endsection
