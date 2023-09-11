<?php

namespace App\Http\Controllers;

use App\Models\GeolocalizacionLaboratorio;
use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LaboratorioController extends Controller
{
     
    public function guardarLaboratorio(Request $request){
        try {
            $requestLab = collect($request->laboratorio)->all();
            $requestGeo = (array)$request->geolocalizacion_laboratorio;
            
            $validateLab = $this->validateLaboratorio($requestLab);
            $response = [];
            
            if ($validateLab['status'] == true) {
                $laboratorio  =  new Laboratorio();
                $laboratorio->nombre = $requestLab['nombre'];
                $laboratorio->lugar = $requestLab['lugar'];
                $laboratorio->status = 'A';


                if ($laboratorio->save()) {
                    foreach ($requestGeo as $dg) {
                        $nuevoGeoLab = new GeolocalizacionLaboratorio();
                        $nuevoGeoLab->laboratorio_id = $laboratorio->id;
                        $nuevoGeoLab->latitud = $dg['lat'];
                        $nuevoGeoLab->longitud = $dg['lng'];
                        $nuevoGeoLab->save();
                    }
                    $response = ['status' => true, 'message' => "El laboratorio se registró con éxito..!  Por favor registre un Módulo para el laboratorio " . ucwords($laboratorio->nombre) ];
                }
            } else {
                 $response = [
                    'status' => false,
                    'message' => 'No se pudo crear el laboratorio',
                    'fails' => [
                        'error_lab' => $validateLab["error"] ?? "No presenta errores"
                    ],
                ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    private function validateLaboratorio($request)
    {
        $rules = [
            'nombre' => 'required|unique:laboratorios,nombre',
            'lugar' => 'required|unique:laboratorios,lugar'
        ];

        $messages = [
            'nombre.required' => 'El Laboratorio es requerido',
            'nombre.unique' => 'El Laboratorio ya ha sido registrado',
            'lugar.unique' => 'El lugar ya ha sido registrado'

        ];
        return $this->validation($request, $rules, $messages);
    }

    public function validation($request, $rules, $messages)
    {
        $response = ['status' => true, 'message' => 'No hubo errores'];

        $validate = Validator::make($request, $rules, $messages);

        if ($validate->fails()) {
            return $response = ['status' => false, 'message' => 'Error de validación', 'error' => $validate->errors()];
        }
        return $response;
    }

    public function editarLaboratorio(Request $request){
        try {
            $requestLaboratorio = (object) $request->laboratorio;
            $requestGeolocalizacion_Laboratorio = (array) $request->geolocalizacion_laboratorio;
            $response = [];

            $nombreExists = Laboratorio::where('nombre', $requestLaboratorio->nombre)->where('status', 'A')->exists();

            $lugarExists = Laboratorio::where('lugar', $requestLaboratorio->lugar)->where('status', 'A')->exists();

            if ($nombreExists) {
                $response = ['status' => false,'message' => 'El nombre del laboratorio ya se encuentra registrado'];
            } else  
            if ($lugarExists) {
                $response = ['status' => false,'message' => 'El lugar del laboratorio ya se encuentra registrado'];
            }else {
                
                $dataLaboratorio = Laboratorio::find($requestLaboratorio->id);

                if($dataLaboratorio){
                    //Editar Laboratorio
                    $dataLaboratorio->nombre = $requestLaboratorio->nombre;
                    $dataLaboratorio->lugar = $requestLaboratorio->lugar;
                    $dataLaboratorio->status = 'A';
        
                    $dataGeolocalizacionLaboratorio = GeolocalizacionLaboratorio::where('laboratorio_id',$dataLaboratorio->id)->get();
                    
                    if ($dataGeolocalizacionLaboratorio) {
                        foreach($dataGeolocalizacionLaboratorio as $item){
                            $item->delete();
                        }
        
                        foreach($requestGeolocalizacion_Laboratorio as $item){
                            $newGeolocalizacion_Laboratorio = new GeolocalizacionLaboratorio;
                            $newGeolocalizacion_Laboratorio->laboratorio_id = $requestLaboratorio->id;
                            $newGeolocalizacion_Laboratorio->latitud = $item['lat'];
                            $newGeolocalizacion_Laboratorio->longitud = $item['lng'];
                            $newGeolocalizacion_Laboratorio->save();
                        }
        
                        if($dataLaboratorio->save()){
                            $response = [
                                'status' => true,
                                'message' => 'El laboratorio ' . ucwords($dataLaboratorio->nombre) . ' se ha actualizado con éxito.'                    
                            ];
                        }else{
                            $response = [
                                'status' => false,
                                'message' => 'Error. No se puede actualizar el laboratorio.'                    
                            ];
                        }
                    } else {
                        $response = [
                            'status' => false,
                            'message' => 'Error. No exite el laboratorio en la geolocalización.'                    
                        ];
                    }
                }else{
                    $response = [
                        'status' => false, 
                        'message' => 'No existen datos para procesar.' ];
                }
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    public function listarLaboratorio(){
        try {
            $lab = Laboratorio::where('status','A')->get();
            $response = [];
    
            if ($lab->count() > 0) {
                foreach ($lab as $geo) {
                    $geo->geolocalizacion_laboratorio;
                }
                $response = [ 'status' => true, 'message' => 'Existen datos', 'data' => $lab ];
            }else{
                $response = [ 'status' => false, 'message' => 'No existen datos', 'data' => null ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    public function listarLaboratoriosConsulta()
    {
        try {
            $lab = Laboratorio::where('status','A')->get();
            $response = [];
            $data = [];

            if ($lab->count() > 0) {
                foreach ($lab as $l) {
                    $aux = [
                        'laboratorio_id' => $l->id,
                        'laboratorio' => ucwords($l->nombre) 
                    ];
                    $data[] = (object)$aux; 
                }

                $response = ['status' => true, 'message' => 'Existen datos', 'data' => $data];
            } else {
                $response = ['status' => false, 'message' => 'No existen datos', 'data' => null];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }
}
