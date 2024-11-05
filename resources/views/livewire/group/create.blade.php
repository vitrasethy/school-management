<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create Group</h3>
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
                <label>School Year</label>
                <input wire:model='form.school_year' type="text" class="form-control" placeholder="School Year">
                @error('form.school_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
