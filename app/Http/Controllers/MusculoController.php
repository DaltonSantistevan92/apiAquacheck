<?php

namespace App\Http\Controllers;

use App\Models\Musculo;
use Illuminate\Http\Request;

class MusculoController extends Controller
{
    public function listarMusculos(){
        try {
            $musculo = Musculo::where('status','A')->get();
            $response = [];
    
            if ($musculo->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $musculo ];
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
