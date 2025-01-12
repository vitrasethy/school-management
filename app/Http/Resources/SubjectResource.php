<?php

namespace App\Http\Resources;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Subject
 * @property mixed $pivot
 */
class SubjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abbr' => $this->abbr,

            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'teacher' => $this->whenPivotLoaded('group_subject', function () {
                return new UserResource(User::find($this->pivot->teacher_id));
            }),
            'department' => new DepartmentResource($this->whenLoaded('department')),
        ];
    }
}
