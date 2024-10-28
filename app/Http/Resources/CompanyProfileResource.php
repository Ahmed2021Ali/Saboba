<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status === 0 ? 'Documentation status under review' : 'The organization identity has been successfully verified.',
            'file' => $this->getFirstMediaUrl('documentationFiles'),
        ];
    }
}
