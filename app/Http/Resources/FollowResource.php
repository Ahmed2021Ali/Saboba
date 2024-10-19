<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'follower' => $this->follower->follower??null,
            'following' => $this->following??null,
            'status' => $this->status
        ];
    }
}
