<?php

namespace App\Http\Controllers;

use App\Models\EstadioLarval;
use App\Models\EstadioLarvalValor;

class EstadioLarvalValorsController extends Controller
{

    public function listarEstadioLarvalValor()
    {
        try {
            $estadioLarvalValor = EstadioLarvalValor::with('estadio_larval', 'valor_crecimiento')->get();
            $data = [];  $response = [];
            if ($estadioLarvalValor->count() > 0) {

                foreach($estadioLarvalValor as $elv){
                    $aux = [
                        'estadio_larval_valor_id' => $elv->id,
                        'nombre_estadio_valor_crecimiento' => strtoupper($elv->estadio_larval->abrv) . ' - ' . $elv->valor_crecimiento->valor 
                        //'nombre_estadio_valor_crecimiento' => ucwords($elv->estadio_larval->nombre_estadio) . ' ' . $elv->valor_crecimiento->valor,
                    ];
                    $data[] = (object)$aux; 
                }

                $response = ['status' => true, 'message' => 'Existen datos', 'data' => $data];
                
            } else {
                $response = ['status' => false, 'message' => 'No existen datos', 'data' => null];
            }

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }


}
