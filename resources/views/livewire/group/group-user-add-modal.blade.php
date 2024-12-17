<div>
    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addUserModal">
        Add Student <i class="fa fa-plus ml-2" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="addUserModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Search Student</label>
                        <input type="text" wire:model.live.500ms="search_term" class="form-control"
                               placeholder="Search by name">
                    </div>
                    <ul class="list-group">
                        @foreach ($students as $student)
                            <li wire:key={{$student->id}} class="list-group-item">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{$student->image_url}}" alt="profile_avatar"
                                         class="rounded-circle mr-2"
                                         style="width: 30px; height: 30px; object-fit: cover;">
                                    <p class="mb-0">{{ $student->name }}</p>
                                </div>
                                @if (!$group->users->contains($student))
                                    <button wire:click="addStudent({{ $student->id }})" class="btn btn-sm btn-success">
                                        Add
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>
                                        Added
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
