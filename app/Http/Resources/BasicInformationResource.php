<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicInformationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'job_title' => $this->job_title,
            'nationality' => $this->nationality,
            'age' => $this->age,
            'gender' => $this->gender,
        ];
    }
}
