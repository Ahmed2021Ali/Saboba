<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'whatsapp_number' => $this->whatsapp_number,
            'contact_number' => $this->contact_number,
            'overview' => $this->overview,
            'files' => ImagesResource::collection($this->getMedia('userImages')),
            'identify_verification' =>
                $this->type === 'company' ?

                        isset($this->identifyVerification)?

                              $this->identifyVerification->status === 1 ? "true" : "false"

                        : "false"

                : 'Not Identify Verification For User',
        ];
    }
}
