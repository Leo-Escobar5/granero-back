<?php

namespace App\Http\Controllers;

use App\Models\tTodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\ReminderService; // Asegúrate de incluir el servicio

class tTodoController extends Controller
{
    protected $reminderService;

    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = tTodo::all();
        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todo = tTodo::create($request->all());
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource by P value.
     */
    public function show($P)
    {
        $todos = tTodo::where('P', $P)->get();
        return response()->json($todos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $A)
    {
        try {
            // Intenta encontrar la tarea por el valor de 'A'
            $todo = tTodo::where('A', $A)->firstOrFail();

            // Solo actualiza los campos que están presentes en la solicitud
            $todo->update($request->only([
                'Du', 'Prdd', 'Tarea', 'Descripcion', 'Seguimiento', 'Creado',
                'Limite', 'Terminado', 'Ao', 'Bo', 'Co', 'Do', 'Eo', 'Fo', 'Go',
                'Ho', 'Io', 'PCS', 'Estado', 'Created_By', 'Created', 'Updated_By',
                'Updated'
            ]));

            // Retorna la tarea actualizada
            return response()->json(['message' => 'Tarea actualizada correctamente', 'todo' => $todo]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si no encuentra la tarea, devuelve un error 404 con más detalles
            return response()->json(['error' => 'Tarea no encontrada con el A proporcionado: ' . $A], 404);

        } catch (\Exception $e) {
            // Maneja cualquier otro error que ocurra durante la actualización
            return response()->json(['error' => 'Error durante la actualización: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($P)
    {
        $todo = tTodo::where('P', $P)->firstOrFail();
        $todo->delete();
        return response()->json(null, 204);
    }

    public function destroyTodo($id)
    {
        // Encontrar la tarea por ID
        $todo = tTodo::find($id);

        if (is_null($todo)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Eliminar la tarea
        $todo->delete();

        return response()->json(['message' => 'Tarea eliminada correctamente'], 200);
    }

    /**
     * Send reminder emails to users with pending tasks.
     */
    public function sendReminders()
    {
        // Llamamos al método sendReminders del servicio
        $this->reminderService->sendReminders();

        // Opcionalmente, puedes retornar una respuesta
        return response()->json(['message' => 'Recordatorios enviados']);
    }
}
