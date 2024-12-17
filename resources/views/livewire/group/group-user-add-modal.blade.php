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
                <form wire:submit="save">
                    <div class="modal-body">
                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-12">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label>Subject</label>--}}
                        {{--                                    <select wire:model="subject_id" class="form-control">--}}
                        {{--                                        <option value="">Select a Subject</option>--}}
                        {{--                                        @foreach ($subjects as $subject)--}}
                        {{--                                            <option wire:key="{{ $subject->id }}" value="{{ $subject->id }}">--}}
                        {{--                                                {{ $subject->name }}--}}
                        {{--                                            </option>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </select>--}}
                        {{--                                    @error('subject_id')--}}
                        {{--                                    <span class="text-danger">{{ $message }}</span>--}}
                        {{--                                    @enderror--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-12">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label>Teacher</label>--}}
                        {{--                                    <select wire:model="teacher_id" class="form-control">--}}
                        {{--                                        <option value="">Select a Teacher</option>--}}
                        {{--                                        @foreach ($teachers as $teacher)--}}
                        {{--                                            <option wire:key="{{ $teacher->id }}" value="{{ $teacher->id }}">--}}
                        {{--                                                {{ $teacher->name }}--}}
                        {{--                                            </option>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </select>--}}
                        {{--                                    @error('teacher_id')--}}
                        {{--                                    <span class="text-danger">{{ $message }}</span>--}}
                        {{--                                    @enderror--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
