<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use Illuminate\Http\Request;

class DietaController extends Controller
{
    public function listarDietas(){
        try {
            $dieta = Dieta::where('status','A')->get();
            $response = [];
    
            if ($dieta->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $dieta ];
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
