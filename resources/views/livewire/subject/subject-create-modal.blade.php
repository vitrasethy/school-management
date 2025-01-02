<div>
    <button type="button" class="btn btn-sm btn-success mb-2 mb-md-4" data-toggle="modal"
            data-target="#createSubjectModal">
        Create Subject
        <i class="fa fa-plus ml-2" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="createSubjectModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Subject</h5>
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
                                        <label>Faculty</label>
                                        <select wire:model.live="faculty_id" class="form-control">
                                            <option value="">Select a faculty</option>
                                            @foreach ($faculties as $faculty)
                                                <option wire:key="{{ $faculty->id }}" value="{{ $faculty->id }}">
                                                    {{ $faculty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('faculty admin'))
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
                        <button type="submit" class="btn btn-sm btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
