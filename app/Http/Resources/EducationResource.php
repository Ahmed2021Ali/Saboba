<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'specialization' => $this->specialization??null,
            'university' => $this->university??null,
            'employment_type' => $this->employment_type??null,
            'start_date' => $this->start_date??null,
            'end_date' => $this->end_date??null,
        ];
    }
}
