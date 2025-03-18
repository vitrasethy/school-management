<div>
    <button type="button" class="btn btn-sm btn-success mb-2 mb-md-4" data-toggle="modal" data-target="#createGroupModal">
        Create Group <i class="fa fa-plus ml-2" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="createGroupModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Group</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit="save">
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
                                            @foreach ($faculties as $school)
                                                <option wire:key="{{ $school->id }}" value="{{ $school->id }}">
                                                    {{ $school->name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                    <select wire:model="form.school_year_id" class="form-control">
                                        <option value="">Select a School Year</option>
                                        @foreach ($school_years as $year)
                                            <option wire:key="{{ $year->id }}" value="{{ $year->id }}">
                                                {{ $year->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.school_year_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select wire:model="form.year_id" class="form-control">
                                        <option value="">Select a Year</option>
                                        @foreach ($years as $year)
                                            <option wire:key="{{ $year->id }}" value="{{ $year->id }}">
                                                {{ $year->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.year_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select wire:model="form.semester_id" class="form-control">
                                        <option value="">Select a Semester</option>
                                        @foreach ($semesters as $semester)
                                            <option wire:key="{{ $semester->id }}" value="{{ $semester->id }}">
                                                {{ $semester->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.semester_id')
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
