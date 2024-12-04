<?php

namespace App\Http\Resources;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Response */
class ResponseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'user' => new AuthResource($this->whenLoaded('user')),
            'form' => new FormResource($this->whenLoaded('form')),
        ];
    }
}
