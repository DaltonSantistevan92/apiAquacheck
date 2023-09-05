<?php

namespace App\Http\Controllers;

use App\Models\Lipido;
use Illuminate\Http\Request;

class LipidoController extends Controller
{
    public function listarLipidos(){
        try {
            $lipido = Lipido::where('status','A')->get();
            $response = [];
    
            if ($lipido->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $lipido ];
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
