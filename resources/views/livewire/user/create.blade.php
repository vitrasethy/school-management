<div>
    <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#createUserModal">
        Create User
    </button>
    <div class="modal fade" id="createUserModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
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
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input wire:model="form.email" type="email" class="form-control"
                                        placeholder="Email">
                                    @error('form.email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if ($user->is_super_admin)
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>School</label>
                                        <select wire:model.live="form.school_id" class="form-control">
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
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select wire:model.live="form.role_id" class="form-control">
                                        <option value="">Select a Role</option>
                                        @foreach ($roles as $role)
                                            <option wire:key="{{ $role->id }}" value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.role_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if ($form->role_id > 1 && $form->school_id != 0 && $user->role_id != 2)
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select wire:model.live="form.department_id" class="form-control">
                                            <option value="">Select a Department</option>
                                            @foreach ($departments as $department)
                                                <option wire:key="{{ $department->id }}"
                                                    value="{{ $department->id }}">
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
                            @if ($form->role_id > 2 && $form->school_id != 0 && $form->department_id != 0)
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Group</label>
                                        <select wire:model="form.group_id" class="form-control">
                                            <option value="">Select a Group</option>
                                            @foreach ($groups as $group)
                                                <option wire:key="{{ $group->id }}" value="{{ $group->id }}">
                                                    {{ $group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('form.group_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input wire:model="form.password" type="password" class="form-control"
                                        placeholder="Password">
                                    @error('form.password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
