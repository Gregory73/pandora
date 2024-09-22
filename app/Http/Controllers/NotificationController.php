<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Mostrar las notificaciones del usuario logueado
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())->where('is_read', false)->get();
        return view('notifications.index', compact('notifications'));
    }

    // Marcar una notificación como leída
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notification->update(['is_read' => true]);

        return redirect()->route('notifications.index')->with('status', 'Notificación marcada como leída.');
    }

    // Eliminar una notificación
    public function destroy($id)
    {
        $notification = Notification::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notification->delete();

        return redirect()->route('notifications.index')->with('status', 'Notificación eliminada.');
    }
}
