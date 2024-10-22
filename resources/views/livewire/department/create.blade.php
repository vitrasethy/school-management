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
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
