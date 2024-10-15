<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'job_title' => $this->job_title,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'employment_type' => $this->employment_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status
        ];
    }
}
