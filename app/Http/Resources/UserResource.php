<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRoleNames(),

            'groups' => GroupResource::collection($this->whenLoaded('groups')),
            'user_affiliations' => UserAffiliationResource::collection($this->whenLoaded('userAffiliations')),
        ];
    }
}
