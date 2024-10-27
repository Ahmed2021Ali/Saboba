<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'chat_with_id' => $this->sender_id === auth()->user()->id ? $this->receiver_id : $this->sender_id,
            'chat_with_name' => $this->sender_id === auth()->user()->id ? $this->receiver->name : $this->sender->name,
            'ad_id' => $this->ad_id,
            'last_message' => $this->last_message,
            'last_time_message' => $this->last_time_message/*->format('Y-m-d H:i:s')*/

        ];
    }
}
