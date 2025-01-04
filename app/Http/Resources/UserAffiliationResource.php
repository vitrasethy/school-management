<?php

namespace App\Http\Resources;

use App\Models\UserAffiliation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserAffiliation */
class UserAffiliationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'faculty' => new FacultyResource($this->whenLoaded('faculty')),
            'department' => new DepartmentResource($this->whenLoaded('faculty')),
        ];
    }
}
