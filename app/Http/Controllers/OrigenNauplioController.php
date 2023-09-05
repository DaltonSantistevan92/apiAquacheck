<?php

namespace App\Http\Controllers;

use App\Models\OrigenNauplio;
use Illuminate\Http\Request;

class OrigenNauplioController extends Controller
{
    public function listarOrigenNauplio(){
        try {
            $nauplios = OrigenNauplio::where('status','A')->get();
            $response = [];
    
            if ($nauplios->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $nauplios ];
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
