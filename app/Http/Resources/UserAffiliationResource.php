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
            'user_id' => $this->user_id,
            'faculty_id' => $this->faculty_id,
            'department_id' => $this->department_id,
            'group_id' => $this->group_id,
        ];
    }
}
