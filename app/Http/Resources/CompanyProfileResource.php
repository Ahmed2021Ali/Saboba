<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'file' => $this->getFirstMediaUrl('documentationFiles'),
        ];
    }
}
