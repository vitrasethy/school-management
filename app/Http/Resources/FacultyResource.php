<?php

namespace App\Http\Resources;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Faculty */
class FacultyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'abbr' => $this->abbr,
            'image_url' => $this->image_url,

            'user_affiliations' => UserAffiliationResource::collection($this->whenLoaded('userAffiliations')),
            'departments' => DepartmentResource::collection($this->whenLoaded('departments')),
        ];
    }
}
