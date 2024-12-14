<div>
    <button type="button" class="btn btn-sm btn-warning text-white" data-toggle="modal"
            data-target="#editGroupSubjectModal-{{ $subject->id }}">
        <i class="fa fa-pen" aria-hidden="true"></i>
    </button>
    <div class="modal fade" id="editGroupSubjectModal-{{ $subject->id }}" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Group Subject</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        {{--                        @if (session()->has('message'))--}}
                        {{--                            <div class="alert alert-{{ session('alert-type', 'info') }} text-white">--}}
                        {{--                                {{ session('message') }}--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <select wire:model="subject_id" class="form-control">
                                        <option value="">Select a Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option wire:key="{{ $subject->id }}" value="{{ $subject->id }}">
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Teacher</label>
                                    <select wire:model="user_id" class="form-control">
                                        <option value="">Select a Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option wire:key="{{ $teacher->id }}" value="{{ $teacher->id }}">
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
