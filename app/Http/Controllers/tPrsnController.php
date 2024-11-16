<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tPrsn;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class tPrsnController extends Controller
{
    // GET: api/tPrsn/of/{of}
    public function getByOf($of)
    {
        try
        {
            $tprsnList = tPrsn::where('Of', $of)
                ->get()
                ->map(function($prsn) {
                    return [
                        'P' => $prsn->P,
                        'Of' => $prsn->Of,
                        'Out' => $prsn->Out,
                        'Nombre' => $prsn->Nombre,
                        'Segundo' => $prsn->Segundo,
                        'APaterno' => $prsn->APaterno,
                        'AMaterno' => $prsn->AMaterno,
                        'Prefijo' => $prsn->Prefijo,
                        'Sufijo' => $prsn->Sufijo,
                        'Puesto' => $prsn->Puesto,
                        'Ext' => $prsn->Ext,
                        'Linkedin' => $prsn->Linkedin,
                        'TCel1' => $prsn->TCel1,
                        'TSwB' => $prsn->TSwB,
                        'TOf' => $prsn->TOf,
                        'TOf2' => $prsn->TOf2,
                        'TAssist' => $prsn->TAssist,
                        'TCel2' => $prsn->TCel2,
                        'THome' => $prsn->THome,
                        'TFax' => $prsn->TFax,
                        'eMailw' => $prsn->eMailw,
                        'eMailp' => $prsn->eMailp,
                        'Elec' => $prsn->Elec,
                        'HCPy' => $prsn->HCPy,
                        'Asistente' => $prsn->Asistente,
                        'When' => $prsn->When,
                        'Where' => $prsn->Where,
                        'PE' => $prsn->PE,
                        'BS' => $prsn->BS,
                        'MS' => $prsn->MS,
                        'PhD' => $prsn->PhD,
                        'Notas' => $prsn->Notas,
                        'Created_By' => $prsn->Created_By,
                        'Created' => $prsn->Created,
                        'Updated' => $prsn->Updated,
                        'Updated_By' => $prsn->Updated_By,
                        'upsize_ts' => $prsn->upsize_ts
                    ];
                });

            if ($tprsnList->isEmpty()) {
                return response()->json(['message' => 'Not Found'], 404);
            }

            return response()->json($tprsnList);
        }
        catch (\Exception $ex)
        {
            // Registrar el error en los logs
            \Log::error("Error fetching data: " . $ex->getMessage());
            return response()->json(['message' => 'Error fetching data'], 500);
        }
    }

    // PUT: api/tPrsn/{id}
    public function update(Request $request, $id)
    {
        $tprsn = tPrsn::find($id);

        if (is_null($tprsn)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'Of' => 'required|integer',
            'Out' => 'nullable|integer',
            'Nombre' => 'nullable|string',
            'Segundo' => 'nullable|string',
            'APaterno' => 'nullable|string',
            'AMaterno' => 'nullable|string',
            'Prefijo' => 'nullable|string',
            'Sufijo' => 'nullable|string',
            'Puesto' => 'nullable|string',
            'Ext' => 'nullable|string',
            'Linkedin' => 'nullable|string',
            'TCel1' => 'nullable|string',
            'TSwB' => 'nullable|string',
            'TOf' => 'nullable|string',
            'TOf2' => 'nullable|string',
            'TAssist' => 'nullable|string',
            'TCel2' => 'nullable|string',
            'THome' => 'nullable|string',
            'TFax' => 'nullable|string',
            'eMailw' => 'nullable|string',
            'eMailp' => 'nullable|string',
            'Elec' => 'nullable|date',
            'HCPy' => 'nullable|date',
            'Asistente' => 'nullable|string',
            'When' => 'nullable|date',
            'Where' => 'nullable|string',
            'PE' => 'nullable|boolean',
            'BS' => 'nullable|boolean',
            'MS' => 'nullable|boolean',
            'PhD' => 'nullable|boolean',
            'Notas' => 'nullable|string',
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
        if ($tprsn->upsize_ts !== $request->input('upsize_ts')) {
            return response()->json(['message' => 'La entidad ha sido modificada por otro usuario. Por favor, recargue los datos y vuelva a intentar.', 'entity' => $tprsn], 409);
        }

        $tprsn->fill($request->all());
        $tprsn->save();

        return response()->json($tprsn);
    }

    // POST: api/tPrsn
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Of' => 'required|integer',
            'Out' => 'nullable|integer',
            'Nombre' => 'nullable|string',
            'Segundo' => 'nullable|string',
            'APaterno' => 'nullable|string',
            'AMaterno' => 'nullable|string',
            'Prefijo' => 'nullable|string',
            'Sufijo' => 'nullable|string',
            'Puesto' => 'nullable|string',
            'Ext' => 'nullable|string',
            'Linkedin' => 'nullable|string',
            'TCel1' => 'nullable|string',
            'TSwB' => 'nullable|string',
            'TOf' => 'nullable|string',
            'TOf2' => 'nullable|string',
            'TAssist' => 'nullable|string',
            'TCel2' => 'nullable|string',
            'THome' => 'nullable|string',
            'TFax' => 'nullable|string',
            'eMailw' => 'nullable|string',
            'eMailp' => 'nullable|string',
            'Elec' => 'nullable|date',
            'HCPy' => 'nullable|date',
            'Asistente' => 'nullable|string',
            'When' => 'nullable|date',
            'Where' => 'nullable|string',
            'PE' => 'nullable|boolean',
            'BS' => 'nullable|boolean',
            'MS' => 'nullable|boolean',
            'PhD' => 'nullable|boolean',
            'Notas' => 'nullable|string',
            'Created_By' => 'nullable|string',
            'Created' => 'nullable|date',
            'Updated' => 'nullable|date',
            'Updated_By' => 'nullable|string',
            'upsize_ts' => 'nullable|timestamp',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tprsn = tPrsn::create($request->all());
        return response()->json($tprsn, 201);
    }

    private function tPrsnExists($id)
    {
        return tPrsn::where('P', $id)->exists();
    }

    public function deletePrsnAndRelatedRecords($id)
{
    try {
        // Llamar al procedimiento almacenado
        DB::statement('CALL DeletePrsnAndRelatedRecords(?)', [$id]);

        return response()->json(['message' => 'Registro eliminado exitosamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar el registro.', 'error' => $e->getMessage()], 500);
    }
}

}
