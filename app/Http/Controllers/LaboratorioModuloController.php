<?php

namespace App\Http\Controllers;

use App\Models\LaboratorioModulo;
use Illuminate\Http\Request;

class LaboratorioModuloController extends Controller
{
    //
    public function asignacionesLabMod(Request $request){
        try {
            $requestLabMod = (object) $request;
            
            $existeAsignacion = LaboratorioModulo::where('laboratorio_id',$requestLabMod->laboratorio_id)->where('modulo_id',$requestLabMod->modulo_id)->first();
            if ($existeAsignacion) {
                $response = ['status' => false, 'message' => "El Laboratorio y el Módulo ya fueron asignados"];
            } else {
                $datalm = new LaboratorioModulo();
                $datalm->laboratorio_id  = $requestLabMod->laboratorio_id ;
                $datalm->modulo_id  = $requestLabMod->modulo_id ;
                $datalm->save();

                $response = ['status' => true, 'message' => "La asignación se registró con éxito"];
            } 
         return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function asignacionesLabModEliminar($laboratorio_modulo_id){
        try {
            $datalm = LaboratorioModulo::find($laboratorio_modulo_id);
            $response = [];

            if ($datalm) {
                $datalm->delete();

                $response = ['status' => true, 'message' => "La asignación se eliminó con éxito"];
            } else {
                $response = ['status' => false, 'message' => "No se puede eliminar la asignación"];
            }
         return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function asignacionesListar(){
        try {
            $asig = LaboratorioModulo::all();
            $response = [];

            if ($asig->count() > 0) {
                foreach ($asig as $da) {
                    $da->laboratorio;
                    $da->modulo;
                }
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $asig ];
                
            } else {
                $response = [ 'status' => false, 'message' => 'No existen datos', 'data' => null ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    public function getLugar($laboratorio_id,$modulo_id){
        $data = LaboratorioModulo::where('laboratorio_id',$laboratorio_id)->where('modulo_id',$modulo_id)->first();

        if ( $data ) {
            $lugar = ucwords($data->laboratorio->lugar);

            $response = ['status' => true, 'message' => "si hay datos", 'data' => $lugar ];       
        } else {
            $response = ['status' => false, 'message' => "no hay datos", 'data' => null ];       
        }
        return response()->json($response);        
    }
}
