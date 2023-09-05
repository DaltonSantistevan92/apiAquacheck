<?php

namespace App\Http\Controllers;

use App\Models\MediosCultivo;
use Illuminate\Http\Request;

class MediosCultivoController extends Controller
{
    public function listarMedioCultivos(){
        try {
            $medios = MediosCultivo::where('status','A')->get();
            $response = [];
    
            if ($medios->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $medios ];
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
