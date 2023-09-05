<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function listarActividad(){
        try {
            $actvidad = Actividad::where('status','A')->get();
            $response = [];
    
            if ($actvidad->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $actvidad ];
            }else{
                $response = [ 'status' => false, 'message' => 'No existen datos', 'data' => null ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }
}
