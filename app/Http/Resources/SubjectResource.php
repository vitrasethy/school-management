<?php

namespace App\Http\Resources;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Subject */
class SubjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'teacher' => new UserResource($this->whenLoaded('teacher')),
            'group' => new GroupResource($this->whenLoaded('group')),
            'classrooms' => ClassroomResource::collection($this->whenLoaded('teacher')),
        ];
    }
}
