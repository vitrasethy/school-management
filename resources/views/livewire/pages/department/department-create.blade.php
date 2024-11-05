<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Department</h3>
        </div>
        <form wire:submit='save'>
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input wire:model='form.name' type="text" class="form-control" placeholder="Name">
                    @error('form.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>School</label>
                    <select wire:model='form.school_id' class="form-control">
                        <option value="">Select a school</option>
                        @foreach ($schools as $school)
                            <option wire:key='{{ $school->id }}' value="{{ $school->id }}">{{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('form.school_id')
                        <span class="text-danger">The school field is required.</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>


@section('js')
    <script>
        $(document).ready(function() {
            $("#sidebar li a").removeClass("active");
            $("#department>a").addClass("active");
            $("#department").addClass("menu-open");
            $("#department-create").addClass("my-active");
        });
    </script>
@endsection
