<?php

namespace App\Http\Controllers;

use App\Models\Branquia;
use Illuminate\Http\Request;

class BranquiaController extends Controller
{
    public function listarBranquias(){
        try {
            $branquias = Branquia::where('status','A')->get();
            $response = [];
    
            if ($branquias->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $branquias ];
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
