<?php

namespace App\Http\Controllers;

use App\Models\Alimentacion;
use Illuminate\Http\Request;

class AlimentacionController extends Controller
{
    public function listarAlimentaciones(){
        try {
            $alimentacion = Alimentacion::where('status','A')->get();
            $response = [];
    
            if ($alimentacion->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $alimentacion ];
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
