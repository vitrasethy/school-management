<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Department */
class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'image_url' => $this->image_url,
            'abbr' => $this->abbr,

            'faculty' => new FacultyResource($this->whenLoaded('faculty')),
            'user_affiliations' => UserAffiliationResource::collection($this->whenLoaded('userAffiliations')),
            'groups' => GroupResource::collection($this->whenLoaded('groups')),
        ];
    }
}
