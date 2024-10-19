<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create School</h3>
        </div>
        <form wire:submit='save'>
            <div class="card-body">
                <div class="form-group">
                    <label>Latin Name</label>
                    <input wire:model='form.name' type="text" class="form-control" placeholder="Name">
                    @error('form.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Khmer Name</label>
                    <input wire:model='form.khmerName' type="text" class="form-control" placeholder="Khmer Name">
                    @error('form.khmerName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
