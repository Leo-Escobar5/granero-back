<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tCom;
use Illuminate\Support\Facades\Validator;

class tComController extends Controller
{
    // GET: api/tCom
    public function index()
    {
        $tcoms = tCom::all();
        return response()->json($tcoms);
    }

    // GET: api/tCom/{p}
    public function getByP($p)
    {
        $tcomList = tCom::where('P', $p)->get();

        if ($tcomList->isEmpty()) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($tcomList);
    }

    // POST: api/tCom
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'P' => 'required|integer',
            'Fecha' => 'nullable|date',
            'Ow' => 'nullable|string',
            'ComTy' => 'nullable|string',
            'Contenido' => 'nullable|string',
            'Segui' => 'nullable|date',
            'Created_By' => 'nullable|string',
            'Created' => 'nullable|date',
            'Updated' => 'nullable|date',
            'Updated_By' => 'nullable|string',
            'upsize_ts' => 'nullable|timestamp',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tcom = tCom::create($request->all());
        return response()->json($tcom, 201);
    }

    // PUT: api/tCom/{id}
    public function update(Request $request, $id)
    {
        $tcom = tCom::find($id);

        if (is_null($tcom)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'P' => 'required|integer',
            'Fecha' => 'nullable|date',
            'Ow' => 'nullable|string',
            'ComTy' => 'nullable|string',
            'Contenido' => 'nullable|string',
            'Segui' => 'nullable|date',
            'Created_By' => 'nullable|string',
            'Created' => 'nullable|date',
            'Updated' => 'nullable|date',
            'Updated_By' => 'nullable|string',
            'upsize_ts' => 'nullable|timestamp',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Manejar la concurrencia optimista
        if ($tcom->upsize_ts !== $request->input('upsize_ts')) {
            return response()->json(['message' => 'La entidad ha sido modificada por otro usuario. Por favor, recargue los datos y vuelva a intentar.', 'entity' => $tcom], 409);
        }

        $tcom->fill($request->all());
        $tcom->save();

        return response()->json($tcom);
    }

    private function tComExists($id)
    {
        return tCom::where('L', $id)->exists();
    }

    public function destroy($id)
{
    // Encontrar el registro por su ID
    $tcom = tCom::find($id);

    if (is_null($tcom)) {
        return response()->json(['message' => 'Not Found'], 404);
    }

    // Eliminar el registro
    $tcom->delete();

    return response()->json(['message' => 'Registro eliminado exitosamente.'], 200);
}

}
