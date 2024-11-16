<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\tTodoController;
use Illuminate\Support\Facades\Log;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send daily reminders to users';

    public function handle()
    {
        // Mensaje de depuración
        $this->info('SendReminders command is being executed.');

        try {
            // Instanciamos el controlador y ejecutamos sendReminders
            $controller = new tTodoController();
            $controller->sendReminders();

            // Mostrar un mensaje de éxito en la consola
            $this->info('Reminder emails sent successfully.');

            // Escribir en el log para tener un registro
            Log::info('Reminder emails sent successfully.');

        } catch (\Exception $e) {
            // Capturar y manejar cualquier error
            $this->error('Failed to send reminders: ' . $e->getMessage());
            Log::error('Failed to send reminders: ' . $e->getMessage());
        }
    }
}
