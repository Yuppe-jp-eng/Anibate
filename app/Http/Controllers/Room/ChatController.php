<?php

namespace App\Http\Controllers\Room;

use App\Chat;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(int $room_id) {
        $room = Room::find($room_id);
        $chats = $room->getChatsWithUser();
        return view('chat.show', compact('chats', 'room'));
    }

    public function store(Request $request, Chat $chat) {
        $chat->fill($request->all())->save();
        $room = Room::find($request->room_id);
        $chats = $room->getChatsWithUser();

        return $chats;
    }
}
