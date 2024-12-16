<div>
    <button type="button" class="btn btn-sm btn-warning text-white" data-toggle="modal"
            data-target="#editSubjectModal-{{ $subject->id }}">
        <i class="fa fa-pen" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="editSubjectModal-{{ $subject->id }}" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            @if (Auth::user()->hasRole('super admin'))
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>School</label>
                                        <select wire:model.live="school_id" class="form-control">
                                            <option value="">Select a School</option>
                                            @foreach ($schools as $school)
                                                <option wire:key="{{ $school->id }}" value="{{ $school->id }}">
                                                    {{  $school->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
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
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input wire:model="form.name" type="text" class="form-control"
                                               placeholder="Subject Name">
                                        @error('form.name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->hasRole('school admin'))
                                <div class="col-12">
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
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input wire:model="form.name" type="text" class="form-control"
                                               placeholder="Subject Name">
                                        @error('form.name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->hasRole('department admin'))
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input wire:model="form.name" type="text" class="form-control"
                                               placeholder="Subject Name">
                                        @error('form.name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
