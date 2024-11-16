<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\tTodo;

class ReminderService
{
    public function sendReminders()
    {
        try {
            // Log para verificar si el método ha sido llamado
            Log::info('sendReminders method called.');

            $todos = tTodo::select('t_todo.Tarea', 't_todo.Descripcion', 't_todo.Seguimiento', 't_todo.Creado', 't_todo.Limite', 't_users.Nombre_Usuario', 't_users.Usuario', 't_users.Correo_Electronico')
                ->join('tPrsn', 't_todo.P', '=', 'tPrsn.P')
                ->join('tLctn', 'tPrsn.Of', '=', 'tLctn.Of')
                ->join('tCmpy', 'tLctn.O', '=', 'tCmpy.O')
                ->join('t_users', 'tCmpy.Created_By', '=', 't_users.Usuario')
                ->whereDate('t_todo.Limite', Carbon::today())  // Filtra por la fecha de hoy
                ->whereNull('t_todo.Terminado')
                ->get()
                ->groupBy('Usuario'); // Agrupar por usuario

            // Log para saber si se han encontrado tareas pendientes
            if ($todos->isEmpty()) {
                Log::info('No pending tasks found for today.');
                return;
            }

            // Log para verificar que se encontró al menos un usuario con tareas pendientes
            Log::info('Pending tasks found for users. Sending reminders...');

            foreach ($todos as $usuario => $tareas) {
                $correo = $tareas->first()->Correo_Electronico; // Obtener el correo del usuario
                $nombre = $tareas->first()->Nombre_Usuario; // Obtener el nombre del usuario

                // Log para ver a quién se está enviando el correo
                Log::info("Sending reminder to {$correo} ({$nombre})");

                try {
                    // Enviar el correo con todas las tareas del usuario
                    Mail::send('emails.reminder', ['tareas' => $tareas, 'nombre' => $nombre], function($message) use ($correo, $nombre) {
                        $message->to($correo)
                            ->subject("Recordatorio de tareas pendientes");
                    });

                    // Log para confirmar que el correo fue enviado
                    Log::info("Reminder sent to {$correo}");

                } catch (\Exception $e) {
                    // Manejar cualquier error específico durante el envío de correo y loguearlo
                    Log::error("Failed to send reminder to {$correo}: " . $e->getMessage());
                }
            }

            // Log para indicar que todos los correos han sido enviados
            Log::info('All reminders sent successfully.');

        } catch (\Exception $e) {
            // Log para capturar cualquier error que ocurra en el proceso
            Log::error('Error in sendReminders method: ' . $e->getMessage());
        }
    }
}
