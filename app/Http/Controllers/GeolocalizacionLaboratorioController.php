<?php

namespace App\Http\Controllers;

use App\Models\GeolocalizacionLaboratorio;
use Illuminate\Http\Request;

class GeolocalizacionLaboratorioController extends Controller
{
    //
    public function guadarGeolocalizaciones($laboratorio_id, $detalle){
        $response = [];
        //return response()->json($detalle, 200); die();
        if ($detalle->count() > 0) {
            foreach ($detalle as $dg) {
                $nuevo = new GeolocalizacionLaboratorio();
                $nuevo->laboratorio_id  = $laboratorio_id;
                $nuevo->ubicacion_id  = $dg['ubicacion_id'];
                $nuevo->latitud = $dg['lat'];
                $nuevo->longitud = $dg['lng'];
                $nuevo->save();
            }
            return $nuevo;
        } else {
            return $response = ['status' => false, 'message' => "No hay geolocalizaciones para guardar"];
        }
        return $response;
    }

    //algoritmo para sacar el laboratorio
    private function buscarUbicacion($latitud,$longitud)
    {
        $ubicacion = GeolocalizacionLaboratorio::select()
            ->whereBetween('latitud', [$latitud - 0.001, $latitud + 0.001])
            ->whereBetween('longitud', [$longitud - 0.001, $longitud + 0.001])
            ->orderByRaw("ST_Distance_Sphere(point(longitud, latitud), point($longitud, $latitud))")
            ->first();

        if ($ubicacion) {
            foreach($ubicacion->laboratorio->laboratorio_modulo as $lm){
                $lm->modulo;
            }
            $response = [
                'status' => true,
                'message' => 'La ubicacion existe en nuestro registros',
                'ubicacion' => $ubicacion
            ];
            return $response;
        } else {
            $response = [
                'status' => false,
                'message' => 'Ubicación no establecida para chequear..!!',
            ];
            return $response;
        }
    }

    public function validarGeolocalizacionController($listaUbicacion){//para los controller

        if ($listaUbicacion) {
            foreach($listaUbicacion as $lu){
                $latitud = $lu['latitud'];
                $longitud = $lu['longitud'];
            }
            $resp = $this->buscarUbicacion($latitud, $longitud);
            return $resp; 
        }
    }

    public function validarGeolocalizacion(Request $request){//para los api rest

        $listaUbicacion = (object)$request->ubicacion;

        if ($listaUbicacion) {
            foreach($listaUbicacion as $lu){
                $latitud = $lu['latitud'];
                $longitud = $lu['longitud'];
            }
            $resp = $this->buscarUbicacion($latitud, $longitud);
            return $resp; 
        }
    }
}
