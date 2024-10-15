<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicInformationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'job_title' => $this->job_title??null,
            'nationality' => $this->nationality??null,
            'age' => $this->age??null,
            'gender' => $this->gender??null ,
        ];
    }
}
