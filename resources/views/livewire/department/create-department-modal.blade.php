<div>
    <button type="button" class="btn btn-sm btn-success mb-2 mb-md-4" data-toggle="modal"
            data-target="#createDepartmentModal">
        Create Department
        <i class="fa fa-plus ml-2" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="createDepartmentModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Department</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            @role('super admin')
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
                                    <label>School</label>
                                    <select wire:model="form.school_id" class="form-control">
                                        <option value="">Select a school</option>
                                        @foreach ($schools as $school)
                                            <option wire:key="{{ $school->id }}" value="{{ $school->id }}">
                                                {{ $school->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.school_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endrole
                            @role('school admin')
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
                            @endrole
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
