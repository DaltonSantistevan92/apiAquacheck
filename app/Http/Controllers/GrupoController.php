<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function listarGrupo()
    {
        try {
            $grupo = Grupo::where('status', 'A')->get();
            $response = [];

            if ($grupo->count() > 0) {
                $response = ['status' => true, 'message' => 'Existen datos', 'data' => $grupo];
            } else {
                $response = ['status' => false, 'message' => 'No existen datos', 'data' => null];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }
}
