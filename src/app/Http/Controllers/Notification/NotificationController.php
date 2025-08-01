<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;

use App\Http\Middleware\EnsureUserIsDoctor;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(EnsureUserIsDoctor::class);
    }
    //
    public function index(Request $request):JsonResponse
    {

        // Return all notifications for the authenticated user
        return response()->json(
            $request->user()->notifications
        );
    }

    public function unread(Request $request):JsonResponse
    {
        // Return unread notifications for the authenticated user

        return response()->json(
            $request->user()->unreadNotifications
        );
    }

    public function markAsRead(Request $request, $id):JsonResponse
    {
        // Mark a specific notification as read for the authenticated user
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['message' => 'Notificación marcada como leída']);
    }

    public function markAllAsRead(Request $request):JsonResponse
    {
        // Mark all unread notifications as read for the authenticated user
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Todas las notificaciones marcadas como leídas']);
    }

    public function destroy(Request $request, $id):JsonResponse
    {
        // Delete a specific notification for the authenticated user

        $notification = $request->user()->notifications()->find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notificación eliminada']);
    }

    public function allDestroy(Request $request):JsonResponse
    {
        // Delete all notifications for the authenticated user
        $request->user()->notifications()->delete();

        return response()->json(['message' => 'Todas las notificaciones eliminadas']);
    }
}
