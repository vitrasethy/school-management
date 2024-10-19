<div>
    <div class="col-12 col-md-6 p-0">
        <livewire:department.department-create :school="$school" />
    </div>
    <div class="col-12 col-md-6 p-0">

    </div>
    <div>
        @foreach ($departments as $department)
            <div>{{ $department->name }}</div>
        @endforeach
    </div>
</div>

{{-- @section('js')
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
@endsection --}}
