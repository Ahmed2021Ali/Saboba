<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Traits\media;
use App\Models\Chat;
use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    use media;

    public function index()
    {
        $chats = Chat::where('receiver_id', Auth::id())
            ->Orwhere('sender_id', Auth::id())->get();
        return response()->json($chats);

    }


    public function send_message(Request $request)
    {
        // validation  ad_id  OR   receiver_id  OR  body OR Files OR Images
        $validationData = $this->Val($request);

        $receiver_id = $validationData['receiver_id'];
        $ad_id = $validationData['ad_id'] ?? null;
        $body = $validationData['body'];
        $files = $validationData['files'];

        // can nullable // cant nullable -> can  receiver_id
        $sender_id = Auth::id();

        // search chat sender and receiver
        $chat = Chat::whereIn('receiver_id', [$receiver_id, $sender_id])
            ->whereIn('sender_id', [$receiver_id, $sender_id])->first();

        // Check chat is set Or Not
        if ($chat) {
            $message = $this->Chat_available($sender_id, $receiver_id, $chat, $files);
        } else {
            $message = $this->New_Chat($sender_id, $receiver_id, $body, $files, $ad_id);
        }
        return response()->json($message);

    }

    public function Val($request)
    {
        $validationData = $request->validate([
            'body' => 'nullable|string', 'files.*' => 'nullable|max:10000',
            'receiver_id' => 'required|exists:users,id', 'ad_id' => 'nullable|exists:ads,id',
        ]);

        if (!isset($validationData['body']) && !isset($validationData['files'])) {
            return response()->json(['error' => 'Your Cant Message Empty , must Send Message Or File ']);
        }
        return $validationData;
    }

    public function Chat_available($sender_id, $receiver_id, $chat, $files)
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
            'ad_id' => $ad_id ?? $chat->ad_id, 'last_message' => $message->last_message,
            'last_time_message' => $message->last_time_message
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

        // check file
        $this->downloadImages($files, $message, 'messageFiles');

        // Update Last Message OR last_time_message
        $chat->update([
            'ad_id' => $ad_id ?? $chat->ad_id, 'last_message' => $message->last_message,
            'last_time_message' => $message->last_time_message
        ]);
        return $message;
    }
}