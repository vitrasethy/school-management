<?php

namespace App\Http\Resources;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Answer */
class AnswerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,

            'response' => new ResponseResource($this->whenLoaded('response')),
            'question' => new QuestionResource($this->whenLoaded('question')),
            'option' => new OptionResource($this->whenLoaded('option')),
        ];
    }
}
