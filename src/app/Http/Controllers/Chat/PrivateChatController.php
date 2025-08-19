<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriveteChat\StoreRequest;
use App\Models\PrivateChat;
use Illuminate\Http\Request;

class PrivateChatController extends Controller
{
    //
    public function store(StoreRequest $request)
    {
        $data = $request->validate();
        $chat = PrivateChat::create($data);

        return response()->json(([
            'message' => 'Chat privado creado correctamente',
            'data' => $chat
        ]));
    }

    public function messages(Request $request, $id)
    {
        $chat = PrivateChat::findOrFail($id);
        $messages = $chat->messages()->with('sender')->get();

        return response()->json([
            'message' => 'Mensajes obtenidos correctamente',
            'data' => $messages
        ]);
    }
}
