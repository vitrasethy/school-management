<div>
    <button type="button" class="btn btn-sm btn-warning text-white" data-toggle="modal"
            data-target="#editUserModal-{{ $user->id }}">
        <i class="fa fa-pen" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="editUserModal-{{ $user->id }}" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
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
                            @role('super admin')
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Faculty</label>
                                    <select wire:model.live="form.faculty_id" class="form-control">
                                        <option value="">Select a faculty</option>
                                        @foreach ($faculties as $faculty)
                                            <option wire:key="{{ $faculty->id }}" value="{{ $faculty->id }}">
                                                {{ $faculty->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.faculty_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endrole
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select wire:model.live="form.role" class="form-control">
                                        <option value="">Select a Role</option>
                                        @foreach ($roles as $role)
                                            {{-- @if (($user->hasRole('school admin') && $role->id == 1) || ($user->hasRole('department admin') && ($role->id == 1 || $role->id == 2)))
                                                @continue
                                            @endif --}}
                                            <option wire:key="{{ $role->id }}" value="{{ $role->name }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.role')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @role(['super admin', 'faculty admin'])
                            @if (
                                ($form->role == 'department admin' || $form->role == 'teacher' || $form->role == 'student') &&
                                    $form->faculty_id != 0)
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
                            @endrole
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
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Profile Image</label>
                                    <input wire:model="form.image_url" type="file" class="form-control-file"
                                           placeholder="Profile Image">
                                    <div class="mt-2">
                                        @if ($form->image_url && is_object($form->image_url))
                                            <img src="{{ $form->image_url->temporaryUrl() }}" class="mt-2"
                                                 style="max-height: 200px" alt="school-logo"/>
                                        @elseif ($form->existing_image)
                                            <img src="{{ $form->existing_image }}" class="mt-2"
                                                 style="max-height: 200px" alt="school-logo"/>
                                        @endif
                                    </div>
                                    @error('form.image_url')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if (($form->role == 'teacher' || $form->role == 'student') && $form->department_id != 0)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Group</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($groups as $group)
                                                <div class="form-check mr-2">
                                                    <input type="checkbox" class="form-check-input"
                                                           id="group-{{ $group->id }}" wire:model="form.group_id_list"
                                                           value="{{ $group->id }}">
                                                    <label class="form-check-label"
                                                           for="group-{{ $group->id }}">{{ $group->name }}
                                                        {{ $group->school_year }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('form.group_id_list')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
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
