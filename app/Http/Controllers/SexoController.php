<?php

namespace App\Http\Controllers;

use App\Models\Sexo;
use Illuminate\Http\Request;

class SexoController extends Controller
{
    public function listarSexo(){
        try {
            $sexos = Sexo::where('status','A')->get();
            $response = [];
    
            if ($sexos->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $sexos ];
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
