<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ChatResource;
use App\Http\Traits\media;
use App\Models\Chat;
use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    use media;

    public function showChats()
    {
        $chats = Chat::where('receiver_id', Auth::id())
            ->Orwhere('sender_id', Auth::id())->get();
        if ($chats->isEmpty()) {
            return response()->json(['message' => 'There are no conversations with you yet, go and chat '], 404);
        }
        return response()->json(['Data' => ChatResource::collection($chats), 'message' => 'Your Chats'], 200);

    }

    public function showMessages($id)
    {
        $chat = Chat::where('id', $id)->where('receiver_id', Auth::id())
            ->Orwhere('sender_id', Auth::id())->first();
        if ($chat) {
            $message = message::where('chat_id', $chat->id)->get();
            return response()->json(['Data' => MessageResource::collection($message), 'message' => 'Your Messages'], 200);
        }
        return response()->json(['message' => 'There are no messages in this conversation.'], 404);
    }


    public function send_message(Request $request)
    {
        // validation  ad_id  OR   receiver_id  OR  body OR Files OR Images
        $validationData = $request->validate([
            'body' => 'nullable|string', 'files.*' => 'nullable|max:10000',
            'receiver_id' => 'required|exists:users,id', 'ad_id' => 'nullable|exists:ads,id',
        ]);
        if ($this->Val($validationData)) {
            return $this->Val($validationData);
        }

        $receiver_id = $validationData['receiver_id'];
        $ad_id = $validationData['ad_id'] ?? null;
        $body = $validationData['body'] ?? null;
        $files = $validationData['files'] ?? null;
        // can nullable // cant nullable -> can  receiver_id
        $sender_id = Auth::id();
        // search chat sender and receiver
        $chat = Chat::whereIn('receiver_id', [$receiver_id, $sender_id])
            ->whereIn('sender_id', [$receiver_id, $sender_id])->first();
        DB::beginTransaction();
        try {
            if ($chat) {
                $message = $this->Chat_available($sender_id, $receiver_id, $body, $chat, $files);
            } else {
                $message = $this->New_Chat($sender_id, $receiver_id, $body, $files, $ad_id);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()],500);
        }
        return response()->json(['Data' => new MessageResource($message), 'message' => 'Send Message Successfully'], 201);
    }

    public function Val($validationData)
    {
        if (!isset($validationData['body']) && !isset($validationData['files'])) {
            return response()->json(['message' => 'Your Cant Message Empty , must Send Message Or File '],404);
        }
        if ($validationData['receiver_id'] === Auth::id()) {
            return response()->json(['message' => 'Cannot send message to yourself'],500);
        }
        return null;
    }

    public function Chat_available($sender_id, $receiver_id, $body, $chat, $files)
    {
        // Create Message
        $message = message::create([
            'sender_id' => $sender_id, 'receiver_id' => $receiver_id,
            'chat_id' => $chat->id, 'body' => $body ?? null
        ]);
        // check file
        $this->downloadImages($files, $message, 'messageFiles');

        // Update Last Message
        $chat->update([
            'ad_id' => $ad_id ?? $chat->ad_id, 'last_message' => $message->body,
            'last_time_message' => $message->created_at
        ]);
        return $message;
    }

    public function New_Chat($sender_id, $receiver_id, $body, $files, $ad_id)
    {
        // create Chat
        $chat = Chat::create([
            'sender_id' => $sender_id, 'receiver_id' => $receiver_id, 'ad_id' => $ad_id,
        ]);

        // Create Message
        $message = message::create([
            'sender_id' => $sender_id, 'receiver_id' => $receiver_id,
            'chat_id' => $chat->id, 'body' => $body
        ]);
        // Update Last Message OR last_time_message
        $chat->update([
            'ad_id' => $ad_id ?? $chat->ad_id, 'last_message' => $message->body,
            'last_time_message' => $message->created_at
        ]);
        // check file
        $this->downloadImages($files, $message, 'messageFiles');

        return $message;
    }
}
