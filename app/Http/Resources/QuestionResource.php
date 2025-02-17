<?php

namespace App\Http\Resources;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Question */
class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'is_required' => $this->is_required,
            'correct_answer' => $this->correct_answer,
            'options' => OptionResource::collection($this->whenLoaded('options')),
        ];
    }
}
