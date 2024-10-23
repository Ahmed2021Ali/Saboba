<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'price' => $this->price,
            // 'translations' => $this->translations()->where('locale', $request->getLanguages())->get(),
            // 'name' => $this->name,
            'price' => $this->price,
            'description' => $this->translations['description'],
            'name' => $this->translations['name'],
        ];
    }
}
