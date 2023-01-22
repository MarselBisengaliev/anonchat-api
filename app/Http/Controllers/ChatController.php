<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Queue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getChat() {
        try {
            $chat = Queue::query()->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json(false);
        }

        return response()->json($chat->chat_id);
    }

    public function createChat(Request $request) {
        $chatOne = $request->get('chatOne');
        $chatTwo = $request->get('chatTwo');

        if ($chatTwo != 0) {
            Queue::query()->where('chat_id', $chatTwo)->delete();
            $chat = Chat::create([
                'chat_one' => $chatOne,
                'chat_two' => $chatTwo
            ]);

            return response()->json($chat);
        } else {
            return response()->json(false);
        }
    }

    public function getActiveChat($chatId) {
        $chat = Chat::query()->where('chat_one', $chatId)->first() ?? null;
        if ($chat) {
            return response()->json([
                'id' => $chat->id,
                'companion' => $chat->chat_two
            ]);
        }

        $chat = Chat::query()->where('chat_two', $chatId)->first() ?? null;
        if ($chat) {
            return response()->json([
                'id' => $chat->id,
                'companion' => $chat->chat_one
            ]);
        }

        return response()->json(false);
    }

    public function deleteChat($chatId) {
        Chat::query()->where('id', $chatId)->delete();
    }
}
