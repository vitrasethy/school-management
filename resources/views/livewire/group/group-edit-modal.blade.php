<div>
    <button type="button" class="btn btn-sm btn-warning text-white" data-toggle="modal"
            data-target="#editGroupModal-{{ $group->id }}">
        <i class="fa fa-pen"
           aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="editGroupModal-{{ $group->id }}" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Group</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
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
                            @if ($user->hasRole('super admin'))
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Faculty</label>
                                        <select wire:model.live="faculty_id" class="form-control">
                                            <option value="">Select a Faculty</option>
                                            @foreach ($faculties as $faculty)
                                                <option wire:key="{{ $faculty->id }}" value="{{ $faculty->id }}">
                                                    {{ $faculty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('faculty_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($user->hasRole('super admin') || $user->hasRole('faculty admin'))
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select wire:model="form.department_id" class="form-control">
                                            <option value="">Select a Department</option>
                                            @foreach ($departments as $department)
                                                <option wire:key="{{ $department->id }}" value="{{ $department->id }}">
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('form.department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>School Year</label>
                                    <input wire:model="form.school_year" type="text" class="form-control"
                                           placeholder="School Year">
                                    @error('form.school_year')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input wire:model="form.semester" type="text" class="form-control"
                                           placeholder="Semester">
                                    @error('form.semester')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input wire:model="form.year" type="text" class="form-control"
                                           placeholder="Year">
                                    @error('form.year')
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
