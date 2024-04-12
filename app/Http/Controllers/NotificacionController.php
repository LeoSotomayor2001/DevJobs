<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        
        // Obtener las notificaciones no leídas del usuario
        $notificaciones = $user->unreadNotifications;
        
        // Obtener el historial de notificaciones leídas del usuario paginadas
        $historialNotificaciones = $user->readNotifications()->paginate(10);
    
        // Marcar las notificaciones no leídas como leídas
        $user->unreadNotifications->markAsRead();
    
        return view('notificaciones.index', [
            'notificaciones' => $notificaciones,
            'historialNotificaciones' => $historialNotificaciones
        ]);
    }
    

}
