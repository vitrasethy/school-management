<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">User Table</h3>
            <div class="row">
                <div class="col-12">
                    <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                           placeholder="Search User"/>
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
                <th>
                    School
                </th>
                <th>
                    Department
                </th>
                <th>
                    Role
                </th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr wire:key='{{ $user->id }}'>
                    <td><img src="{{ $user->image_url ?? asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}"
                             class="rounded-circle mr-2"
                             style="width: 30px; height: 30px; object-fit: cover;"
                             alt="school-logo"/> {{ $user->name }}</td>
                    <td>
                        {{ $user->school ? $user->school->name : 'N/A' }}
                    </td>
                    <td>
                        {{ $user->department ? $user->department->name : 'N/A' }}
                    </td>
                    <td>{{ $user->getRoleNames()[0] }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('home', $user->id) }}" class="btn btn-sm btn-primary mr-2"> <i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            <livewire:user.user-edit-modal :user="$user" :wire:key="'user-modal-'.$user->id"/>
                            <button class="btn btn-sm btn-danger ml-2"
                                    wire:click="$dispatch('alert-delete', {id: {{ $user->id }}})"><i class="fa fa-trash"
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
        {{ $users->links() }}
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#user>a").addClass("active");
            $("#user").addClass("menu-open");
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
                        user_id: event.detail.id
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "User has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endsection
