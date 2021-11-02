<?php

namespace App\Http\Controllers\Room;

use App\Chat;
use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function show(int $room_id) {
        $room = Room::find($room_id);
        if (!$room->includeUser(Auth::id())) {
            return redirect('rooms')->with('flash_message', '権限のない部屋に入ろうとしています');
        }
        $chats = $room->getChatsWithUser();
        return view('chat.show', compact('chats', 'room'));
    }

    /**
     * チャット保存処理
     * @param $request Vue.jsからのAjax通信を用いたチャット送信リクエスト
     * @return Object $new_message(user情報込み)
     */
    public function store(Request $request, Chat $chat) {
        $chat->fill($request->all())->save();
        $new_message = $chat->withUserInfo();

        event(new ChatEvent($new_message));

        return $new_message;
    }
}
