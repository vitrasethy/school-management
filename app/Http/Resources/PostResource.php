<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,

            'user' => new UserResource($this->whenLoaded('user')),
            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'group' => new GroupResource($this->whenLoaded('group')),
        ];
    }
}
