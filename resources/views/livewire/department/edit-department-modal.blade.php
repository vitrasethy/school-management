<div>
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
        data-target="#editDepartmentModal-{{ $department->id }}">
        Edit
    </button>
    <div class="modal fade" id="editDepartmentModal-{{ $department->id }}" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            @if (Auth::user()->role_id == 1)
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
                            @endif
                            @if (Auth::user()->is_super_admin)
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input wire:model="form.name" type="text" class="form-control"
                                            placeholder="Name">
                                        @error('form.name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
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
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
