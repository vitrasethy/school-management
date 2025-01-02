<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Subjects</h3>
            <livewire:group.add-subject-modal :group="$group"
                                              :wire:key="'add-group-subject-modal-'.$group->id"/>
        </div>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Teacher
                </th>
                <th>
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($group->subjects as $subject)
                    <?php
                    $teacher = \App\Models\User::find($subject->pivot->teacher_id);
                    ?>
                <tr wire:key='{{$group->id}}-{{$teacher->id}}-{{ $subject->id }}'>
                    <td>{{ $subject->name }}</td>
                    <td>
                        {{ $teacher ? $teacher->name : 'N/A' }}
                    </td>
                    <td>
                        <div class="d-flex">
                            <livewire:group.edit-subject-modal :subject="$subject"
                                                               :group="$group"
                                                               :teacher="$teacher"
                                                               :wire:key="'edit-group-subject-modal-'.$group->id.$teacher->id.$subject->id"/>
                            <button
                                wire:click="$dispatch('alert-delete', {id: {{ $subject->id }}, teacher_id: {{$teacher->id}}})"
                                class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash"
                                                                      aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
