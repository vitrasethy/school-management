<?php

namespace App\Http\Resources;

use App\Models\Role;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleAssignmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'role' => $this->name,
            'school' => School::find($this->pivot->school_id)->name,
        ];
    }
}
