<div>
    <button type="button" class="btn btn-sm btn-success mb-2 mb-md-4" data-toggle="modal"
            data-target="#createDepartmentModal">
        Create Faculty
        <i class="fa fa-plus ml-2" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="createDepartmentModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Faculty</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input wire:model="form.name" type="text" class="form-control"
                                           placeholder="Name">
                                    @error('form.name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Abbreviate Name</label>
                                    <input wire:model="form.abbr" type="text" class="form-control"
                                           placeholder="Name">
                                    @error('form.abbr')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input wire:model="form.image_url" type="file" class="form-control-file"
                                           placeholder="School Logo">
                                    <div class="mt-2">
                                        @if ($form->image_url)
                                            <img src="{{ $form->image_url->temporaryUrl() }}" class="mt-2"
                                                 style="max-height: 200px" alt="school-logo"/>
                                        @endif
                                    </div>
                                    @error('form.image_url')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
