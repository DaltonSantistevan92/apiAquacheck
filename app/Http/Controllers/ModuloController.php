<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuloController extends Controller
{
    public function listarModulo()
    {
        try {
            $modulo = Modulo::where('status', 'A')->get();
            $response = [];

            if ($modulo->count() > 0) {
                $response = ['status' => true, 'message' => 'Existen datos', 'data' => $modulo];
            } else {
                $response = ['status' => false, 'message' => 'No existen datos', 'data' => null];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function guardarModulo(Request $request)
    {
        try {
            $requestModulo = collect($request)->all();

            $validateMod = $this->validateModulo($requestModulo);
            $response = [];

            if ($validateMod['status'] == true) {
                $nuevoModulo  =  new Modulo();
                $nuevoModulo->nombre_modulo = $requestModulo['nombre_modulo'];
                $nuevoModulo->status = 'A';

                if ($nuevoModulo->save()) {
                    $response = ['status' => true, 'message' => "El módulo se registró con éxito"];
                }
            } else {
                $response = [
                    'status' => false,
                    'message' => 'No se pudo crear el módulo',
                    'fails' => [
                        'error_modulo' => $validateMod["error"] ?? "No presenta errores",
                    ],
                ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function editarModulo(Request $request){
        try {
            $requestModulo = (object) $request;

            $moduloData = Modulo::find($requestModulo->id);
            $response = [];

            if ($moduloData) {
                $existeNombreModulo = Modulo::where('nombre_modulo',$requestModulo->nombre_modulo)->get()->first();

                if ($existeNombreModulo) {
                    $response = ['status' => false, 'message' => 'El nombre ' . ucwords($requestModulo->nombre_modulo) . ' del módulo ya existe'];    
                } else {
                    $moduloData->nombre_modulo = $requestModulo->nombre_modulo;
                    $moduloData->save();

                    $response = ['status' => true, 'message' => 'Se actualizo con éxito'];
                }
            } else {
                $response = ['status' => false, 'message' => 'No hay datos para procesar'];   
            }
            
            return response()->json($response,200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    private function validateModulo($request)
    {
        $rules = [
            'nombre_modulo' => 'nullable|unique:modulos,nombre_modulo',
        ];

        $messages = [
            'nombre_modulo.unique' => 'El Módulo ya ha sido registrado',
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
}
