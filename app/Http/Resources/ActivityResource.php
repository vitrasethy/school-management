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

            'group' => new GroupResource($this->whenLoaded('group')),
            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'activityType' => new ActivityTypeResource($this->whenLoaded('activityType')),
        ];
    }
}
