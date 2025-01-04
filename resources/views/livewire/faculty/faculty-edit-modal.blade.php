<div>
    <button type="button" class="btn btn-sm btn-warning text-white mr-2" data-toggle="modal"
            data-target="#editFacultyModal-{{ $faculty->id }}">
        <i class="fa fa-pen" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="editFacultyModal-{{ $faculty->id }}" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Faculty</h5>
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
                                    <input wire:model="form.image_url" type="file" class="form-control-file">
                                    <div class="mt-2">
                                        @if ($form->image_url && is_object($form->image_url))
                                            <img src="{{ $form->image_url->temporaryUrl() }}" class="mt-2"
                                                 style="max-height: 200px" alt="faculty-logo"/>
                                        @elseif ($form->existing_image)
                                            <img src="{{ $form->existing_image }}" class="mt-2"
                                                 style="max-height: 200px" alt="faculty-logo"/>
                                        @endif
                                        {{--                                        @if ($form->image_url && is_object($form->image_url))--}}
                                        {{--                                            <img src="{{ $form->image_url->temporaryUrl() }}" class="mt-2"--}}
                                        {{--                                                 style="max-height: 200px" alt="school-logo"/>--}}
                                        {{--                                        @elseif ($form->existing_image)--}}
                                        {{--                                            <img src="{{ $form->existing_image }}" class="mt-2"--}}
                                        {{--                                                 style="max-height: 200px" alt="school-logo"/>--}}
                                        {{--                                        @endif--}}
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
                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>