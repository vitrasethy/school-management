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
            'score' => $this->score,

            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'activityType' => new ActivityTypeResource($this->whenLoaded('activityType')),
        ];
    }
}
