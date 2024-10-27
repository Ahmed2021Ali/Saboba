<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'sender_id' => $this->sender_id,
            'sender_name' => $this->sender->name,

            'receiver_id' => $this->receiver_id,
            'receiver_name' => $this->receiver->name,

            'body' => $this->body,
            'files' => ImagesResource::collection($this->getMedia('messageFiles')),
            'create_at' => $this->created_at->format('Y-m-d H:i:s')

        ];
    }
}
