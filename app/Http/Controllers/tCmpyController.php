<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tCmpy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class tCmpyController extends Controller
{
    // GET: api/tCmpy
    public function index(Request $request)
    {
        // Obtener el parámetro shared_with de la solicitud
        $sharedWith = $request->input('shared_with');

        // Verificar si se pasó el parámetro shared_with
        if ($sharedWith) {
            // Filtrar las empresas donde el campo Shared_With incluya el valor del parámetro
            // y donde Ac sea igual a 1
            $tcmpy = tCmpy::where('Shared_With', 'LIKE', '%' . $sharedWith . '%')
                          ->where('Ac', 1)
                          ->get();
            $message = "Se pasó el parámetro shared_with con el valor: " . $sharedWith;
        } else {
            // Obtener todas las empresas donde Ac sea igual a 1
            $tcmpy = tCmpy::where('Ac', 1)->get();
            $message = "No se pasó el parámetro shared_with";
        }

        return response()->json([
            'message' => $message,
            'data' => $tcmpy
        ]);
    }

    // GET: api/tCmpyInactive
    public function indexInactive(Request $request)
    {
        // Obtener el parámetro shared_with de la solicitud
        $sharedWith = $request->input('shared_with');

        // Verificar si se pasó el parámetro shared_with
        if ($sharedWith) {
            // Filtrar las empresas donde el campo Shared_With incluya el valor del parámetro
            // y donde Ac sea igual a 0
            $tcmpy = tCmpy::where('Shared_With', 'LIKE', '%' . $sharedWith . '%')
                          ->where('Ac', 0)
                          ->get();
            $message = "Se pasó el parámetro shared_with con el valor: " . $sharedWith;
        } else {
            // Obtener todas las empresas donde Ac sea igual a 0
            $tcmpy = tCmpy::where('Ac', 0)->get();
            $message = "No se pasó el parámetro shared_with";
        }

        return response()->json([
            'message' => $message,
            'data' => $tcmpy
        ]);
    }

    // GET: api/tCmpy/{id}
    public function show($id)
    {
        $tcmpy = tCmpy::find($id);

        if (is_null($tcmpy)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($tcmpy);
    }

    // POST: api/tCmpy
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'O' => 'nullable|integer',
            'Nombre' => 'nullable|string',
            'Rs' => 'nullable|integer',
            'Ac' => 'nullable|boolean',
            'Type' => 'nullable|string',
            'Industry' => 'nullable|string',
            'SerPro' => 'nullable|string',
            'Origen' => 'nullable|string',
            'URL' => 'nullable|string',
            'Linkedin' => 'nullable|string',
            'eMail' => 'nullable|string',
            'Fnd' => 'nullable|integer',
            'Emplea' => 'nullable|numeric',
            'Ventas' => 'nullable|numeric',
            'Ref' => 'nullable|string',
            'Nota' => 'nullable|string',
            'Company_State' => 'nullable|string',
            'Shared_With' => 'nullable|string',
            'Created_By' => 'nullable|string',
            'Created' => 'nullable|date',
            'Updated' => 'nullable|date',
            'Updated_By' => 'nullable|string',
            'upsize_ts' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tcmpy = tCmpy::create($request->all());
        return response()->json($tcmpy, 201);
    }

    // PUT: api/tCmpy/{id}
    public function update(Request $request, $id)
    {
        $tcmpy = tCmpy::find($id);

        if (is_null($tcmpy)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'O' => 'nullable|integer',
            'Nombre' => 'nullable|string',
            'Rs' => 'nullable|integer',
            'Ac' => 'nullable|boolean',
            'Type' => 'nullable|string',
            'Industry' => 'nullable|string',
            'SerPro' => 'nullable|string',
            'Origen' => 'nullable|string',
            'URL' => 'nullable|string',
            'Linkedin' => 'nullable|string',
            'eMail' => 'nullable|string',
            'Fnd' => 'nullable|integer',
            'Emplea' => 'nullable|numeric',
            'Ventas' => 'nullable|numeric',
            'Ref' => 'nullable|string',
            'Nota' => 'nullable|string',
            'Company_State' => 'nullable|string',
            'Shared_With' => 'nullable|string',
            'Created_By' => 'nullable|string',
            'Created' => 'nullable|date',
            'Updated' => 'nullable|date',
            'Updated_By' => 'nullable|string',
            'upsize_ts' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Manejar la concurrencia optimista
        $current_upsize_ts = $tcmpy->upsize_ts;
        if ($current_upsize_ts !== $request->input('upsize_ts')) {
            return response()->json(['message' => 'La entidad ha sido modificada por otro usuario. Por favor, recargue los datos y vuelva a intentar.', 'entity' => $tcmpy], 409);
        }

        $tcmpy->fill($request->all());
        $tcmpy->save();

        return response()->json($tcmpy);
    }

    public function updateAc(Request $request, $id)
    {
        $tcmpy = tCmpy::find($id);

        if (is_null($tcmpy)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'Ac' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Manejar la concurrencia optimista
        $current_upsize_ts = $tcmpy->upsize_ts;
        if ($current_upsize_ts !== $request->input('upsize_ts')) {
            return response()->json(['message' => 'La entidad ha sido modificada por otro usuario. Por favor, recargue los datos y vuelva a intentar.', 'entity' => $tcmpy], 409);
        }

        // Actualizar el campo 'Ac'
        $tcmpy->Ac = $request->input('Ac');
        $tcmpy->save();

        return response()->json($tcmpy);
    }


    public function deleteCmpyAndRelatedRecords($id)
{
    try {
        // Llamar al procedimiento almacenado
        DB::statement('CALL DeleteCmpyAndRelatedRecords(?)', [$id]);

        return response()->json(['message' => 'Registro eliminado exitosamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar el registro.', 'error' => $e->getMessage()], 500);
    }
}
}
