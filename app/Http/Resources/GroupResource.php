<?php

namespace App\Http\Resources;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Group */
class GroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('groups.show')) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'year' => $this->year,
                'academic_year' => $this->academic_year,
                'semester' => $this->semester,

                'department' => new DepartmentResource($this->whenLoaded('department')),
                'user_affiliations' => UserAffiliationResource::collection($this->whenLoaded('userAffiliations')),
                'users' => UserResource::collection($this->whenLoaded('users')),
                'subjects' => SubjectStudentResource::collection($this->whenLoaded('subjects')),
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'year' => $this->year,
            'academic_year' => $this->academic_year,
            'semester' => $this->semester,

            'department' => new DepartmentResource($this->whenLoaded('department')),
            'user_affiliations' => UserAffiliationResource::collection($this->whenLoaded('userAffiliations')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
        ];
    }
}
