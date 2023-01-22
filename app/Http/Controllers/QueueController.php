<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function addQueue(Request $request) {
        $chatId = $request->get('chatId');
        Queue::create([
            'chat_id' => $chatId
        ]);
    }

    public function deleteQueue($chatId) {
        $queue = Queue::query()->where('chat_id', $chatId)->first();
        $queue->delete();
    }
}
