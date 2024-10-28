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
            'type' => $this->type,
            'files' => ImagesResource::collection($this->getMedia('userImages')),
            'identify_verification' =>
                $this->type === "company" ?

                    $this->identifyVerification() ?

                        $this->identifyVerification()->status === 1 ?
                            "true" //  your account is already verified

                            : "false" //The documentation files have been sent -> Not replay Verify -> Witting Replay Verify

                        : "null" //  Company Not Send files for Verifications

                    : 'Not Identify Verification For User',
        ];
    }
}
