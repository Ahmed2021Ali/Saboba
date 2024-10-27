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

    public function index()
    {
        $chats = Chat::where('receiver_id', Auth::id())
            ->Orwhere('sender_id', Auth::id())->get();
        return response()->json(['Data'=>new ChatResource($chats), 'success' => 'Your Chats'],200);

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
                $message = $this->Chat_available($sender_id, $receiver_id, $body,$chat, $files);
            } else {
                $message = $this->New_Chat($sender_id, $receiver_id, $body, $files, $ad_id);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()]);
        }
        return response()->json(['Data'=>new MessageResource($message), 'success' => 'Send Message Successfully'],201);
    }

    public function Val($validationData)
    {
        if (!isset($validationData['body']) && !isset($validationData['files'])) {
            return response()->json(['error' => 'Your Cant Message Empty , must Send Message Or File ']);
        }
        if ($validationData['receiver_id'] === Auth::id()) {
            return response()->json(['error' => 'Cannot send message to yourself']);
        }
        return null;
    }

    public function Chat_available($sender_id, $receiver_id,$body, $chat, $files)
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
