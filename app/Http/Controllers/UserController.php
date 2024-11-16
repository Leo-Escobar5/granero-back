<?php

namespace App\Http\Controllers;

use App\Models\tUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = tUser::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre_Usuario' => 'required|string|max:255',
            'Usuario' => 'required|string|max:255|unique:t_users',
            'Pass' => 'required|string|min:8',
            // Añadimos la validación para Correo_Electronico, haciéndolo opcional
            'Correo_Electronico' => 'nullable|string|email|max:255|unique:t_users',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $user = new tUser();
            $user->Nombre_Usuario = $request->Nombre_Usuario;
            $user->Usuario = $request->Usuario;
            $user->Pass = Hash::make($request->Pass);
            $user->Rol = $request->Rol;
            $user->Admin = $request->Admin;
            $user->TablaEmpresas = $request->TablaEmpresas;
            $user->Empleados = $request->Empleados;
            $user->Permisos = $request->Permisos;
            $user->UsuariosData = $request->UsuariosData;
            $user->Mostrar_Cinta_Opciones = $request->Mostrar_Cinta_Opciones;
            $user->Activar_Shift = $request->Activar_Shift;

            // Asignar Correo_Electronico si está presente en la solicitud
            if ($request->has('Correo_Electronico')) {
                $user->Correo_Electronico = $request->Correo_Electronico;
            }

            $user->save();

            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating user: ' . $e->getMessage()], 409);
        }
    }

    public function show($id)
    {
        $user = tUser::where('ID_Usuario', $id)->first();

        if ($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $user = tUser::where('ID_Usuario', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->Nombre_Usuario = $request->Nombre_Usuario;
        $user->Usuario = $request->Usuario;
        if ($request->has('Pass')) {
            $user->Pass = Hash::make($request->Pass);
        }
        $user->Rol = $request->Rol;
        $user->Admin = $request->Admin;
        $user->TablaEmpresas = $request->TablaEmpresas;
        $user->Empleados = $request->Empleados;
        $user->Permisos = $request->Permisos;
        $user->UsuariosData = $request->UsuariosData;
        $user->Mostrar_Cinta_Opciones = $request->Mostrar_Cinta_Opciones;
        $user->Activar_Shift = $request->Activar_Shift;
        // Actualizar Correo_Electronico si está presente en la solicitud
        if ($request->has('Correo_Electronico')) {
            $user->Correo_Electronico = $request->Correo_Electronico;
        }
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = tUser::where('ID_Usuario', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre_Usuario' => 'required|string|max:255',
            'Usuario' => 'required|string|max:255|unique:t_users',
            'Pass' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = tUser::create([
            'Nombre_Usuario' => $request->Nombre_Usuario,
            'Usuario' => $request->Usuario,
            'Pass' => Hash::make($request->Pass),
            'Rol' => $request->Rol,
            'Admin' => $request->Admin,
            'TablaEmpresas' => $request->TablaEmpresas,
            'Empleados' => $request->Empleados,
            'Permisos' => $request->Permisos,
            'UsuariosData' => $request->UsuariosData,
            'Mostrar_Cinta_Opciones' => $request->Mostrar_Cinta_Opciones,
            'Activar_Shift' => $request->Activar_Shift,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function signin(Request $request)
{
    $credentials = $request->only('Usuario', 'Pass');

    $user = tUser::where('Usuario', $credentials['Usuario'])->first();

    if ($user && Hash::check($credentials['Pass'], $user->Pass)) {
        // Aquí podrías generar un token de autenticación personalizado si fuera necesario
        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'Nombre_Usuario' => $user->Nombre_Usuario,
                'Usuario' => $user->Usuario
            ]
        ], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}


    public function logout(Request $request)
    {
        // Aquí puedes manejar la lógica de logout si es necesario
        return response()->json(['message' => 'Logged out successfully']);
    }
}
