<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'specialization' => $this->specialization,
            'university' => $this->university,
            'employment_type' => $this->employment_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
