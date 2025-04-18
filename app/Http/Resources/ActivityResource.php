<?php

namespace App\Http\Resources;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Activity */
class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'due_at' => $this->due_at,
            'subject_id' => $this->subject_id,
            'duration' => $this->duration,
            'teacher_id' => $this->teacher_id,
            'form_id' => $this->form_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'groups_count' => $this->groups_count,

            'forms' => new FormResource($this->whenLoaded('form')),
            'group' => new GroupResource($this->whenLoaded('group')),
            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'activityType' => new ActivityTypeResource($this->whenLoaded('activityType')),
        ];
    }
}
