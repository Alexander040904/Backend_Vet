<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $message = Message::create($data);
        MessageSent::dispatch($message);

        return response()->json(([
            'message' => 'Mensaje enviado correctamente',
            'data' => $message
        ]));
    }
}
