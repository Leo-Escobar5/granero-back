<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tCmpyController;
use App\Http\Controllers\tLctnController;
use App\Http\Controllers\tPrsnController;
use App\Http\Controllers\tComController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\tTodoController;

// Ruta de ejemplo para autenticación
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Ruta de prueba
Route::get('/prueba', function () {
    return response()->json(['message' => 'prueba api']);
});

// Rutas para tCmpy
Route::get('/tCmpy', [tCmpyController::class, 'index']); // Obtener todos los registros
Route::get('/tCmpy/inactive', [tCmpyController::class, 'indexInactive']); // Obtener todos los registros inactivos
Route::get('/tCmpy/{id}', [tCmpyController::class, 'show']); // Obtener un registro específico
Route::post('/tCmpy', [tCmpyController::class, 'store']); // Crear un nuevo registro
Route::put('/tCmpy/{id}', [tCmpyController::class, 'update']); // Actualizar un registro existente
Route::patch('tCmpy/{id}/ac', [tCmpyController::class, 'updateAc']); // Actualizar el campo Ac de un registro existente

//eliminar
Route::delete('/tCmpy/{id}', [tCmpyController::class, 'deleteCmpyAndRelatedRecords']);

// También podrías usar el método resource para definir todas las rutas RESTful a la vez
// Route::resource('tCmpy', tCmpyController::class);

// Rutas para tLctn
Route::get('/tLctn', [tLctnController::class, 'index']); // Obtener todos los registros
Route::get('/tLctn/o/{o}', [tLctnController::class, 'getByO']); // Obtener registros por 'O'
Route::put('/tLctn/{id}', [tLctnController::class, 'update']); // Actualizar un registro existente
Route::post('/tLctn', [tLctnController::class, 'store']); // Crear un nuevo registro
//eliminar
Route::delete('/tLctn/{id}', [tLctnController::class, 'deleteLctnAndRelatedRecords']);

// Rutas para tPrsn
Route::get('/tPrsn/of/{of}', [tPrsnController::class, 'getByOf']); // Obtener registros por 'Of'
Route::put('/tPrsn/{id}', [tPrsnController::class, 'update']); // Actualizar un registro existente
Route::post('/tPrsn', [tPrsnController::class, 'store']); // Crear un nuevo registro
//eliminar
Route::delete('/tPrsn/{id}', [tPrsnController::class, 'deletePrsnAndRelatedRecords']);

// Rutas para tCom
Route::get('/tCom', [tComController::class, 'index']); // Obtener todos los registros
Route::get('/tCom/{p}', [tComController::class, 'getByP']); // Obtener registros por 'P'
Route::post('/tCom', [tComController::class, 'store']); // Crear un nuevo registro
Route::put('/tCom/{id}', [tComController::class, 'update']); // Actualizar un registro existente
//eliminar
Route::delete('/tCom/{id}', [tComController::class, 'destroy']);

// Rutas para User (Autenticación y CRUD)
Route::post('/register', [UserController::class, 'register']);
//login pero llamado signin
Route::post('/signin', [UserController::class, 'signin']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/tusers', [UserController::class, 'index']);
Route::post('/tusers', [UserController::class, 'store']);
Route::get('/tusers/{id}', [UserController::class, 'show']);
Route::put('/tusers/{id}', [UserController::class, 'update']);
Route::delete('/tusers/{id}', [UserController::class, 'destroy']);

// Rutas para tTodo
Route::apiResource('todos', tTodoController::class);

Route::get('send-reminders', [tTodoController::class, 'sendReminders']);

//Eliminar
Route::delete('/tTodo/{id}', [tTodoController::class, 'destroyTodo']);

