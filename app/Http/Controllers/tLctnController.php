<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tLctn;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class tLctnController extends Controller
{
    // GET: api/tLctn
    public function index()
    {
        $tlctns = tLctn::all();
        return response()->json($tlctns);
    }

    // GET: api/tLctn/o/{o}
    public function getByO($o)
    {
        $tlctns = tLctn::where('O', $o)->get();

        if ($tlctns->isEmpty()) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($tlctns);
    }

    // PUT: api/tLctn/{id}
    public function update(Request $request, $id)
    {
        $tlctn = tLctn::find($id);

        if (is_null($tlctn)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'O' => 'required|integer',
            'Name' => 'nullable|string',
            'URL' => 'nullable|string',
            'SWB' => 'nullable|string',
            'SWB2' => 'nullable|string',
            'Domicilio' => 'nullable|string',
            'Colonia' => 'nullable|string',
            'City' => 'nullable|string',
            'State' => 'nullable|string',
            'Zip' => 'nullable|string',
            'GPS' => 'nullable|string',
            'Matriz' => 'nullable|integer',
            'Pais' => 'nullable|string',
            'MapEP' => 'nullable|string',
            'Nota' => 'nullable|string',
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
        if ($tlctn->upsize_ts !== $request->input('upsize_ts')) {
            return response()->json(['message' => 'La entidad ha sido modificada por otro usuario. Por favor, recargue los datos y vuelva a intentar.', 'entity' => $tlctn], 409);
        }

        $tlctn->fill($request->all());
        $tlctn->save();

        return response()->json($tlctn);
    }

    // POST: api/tLctn
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'O' => 'required|integer',
            'Name' => 'nullable|string',
            'URL' => 'nullable|string',
            'SWB' => 'nullable|string',
            'SWB2' => 'nullable|string',
            'Domicilio' => 'nullable|string',
            'Colonia' => 'nullable|string',
            'City' => 'nullable|string',
            'State' => 'nullable|string',
            'Zip' => 'nullable|string',
            'GPS' => 'nullable|string',
            'Matriz' => 'nullable|integer',
            'Pais' => 'nullable|string',
            'MapEP' => 'nullable|string',
            'Nota' => 'nullable|string',
            'Created_By' => 'nullable|string',
            'Created' => 'nullable|date',
            'Updated' => 'nullable|date',
            'Updated_By' => 'nullable|string',
            'upsize_ts' => 'nullable|timestamp',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tlctn = tLctn::create($request->all());
        return response()->json($tlctn, 201);
    }

    private function tLctnExists($id)
    {
        return tLctn::where('Of', $id)->exists();
    }

    public function deleteLctnAndRelatedRecords($id)
{
    try {
        // Llamar al procedimiento almacenado
        DB::statement('CALL DeleteLctnAndRelatedRecords(?)', [$id]);

        return response()->json(['message' => 'Registro eliminado exitosamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar el registro.', 'error' => $e->getMessage()], 500);
    }
}

}
