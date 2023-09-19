<?php

namespace App\Http\Controllers;

use App\Models\AnalisisMicroscopio;
use App\Models\CabChequeo;
use App\Models\ChequeoTanque;
use App\Models\DetalleChequeo;
use App\Models\EstadioLarvalValor;
use App\Models\ParametrosFisicoQuimico;
use Illuminate\Http\Request;

class CabChequeoController extends Controller
{
    // public function validarNumeroChequeo($laboratorio_id, $modulo_id)
    // {
    //     try {
    //         $cab_chequeo = CabChequeo::where('laboratorio_id', $laboratorio_id)->where('modulo_id', $modulo_id)->where('finalizado', 'N')->where('status', 'A')->latest()->first();

    //         if ($cab_chequeo) {
    //             $chequeo = $cab_chequeo->chequeo;

    //             $detalleChequeo = DetalleChequeo::where('cab_chequeo_id', $cab_chequeo->id)->first();
    //             $estadio_larval_valor = [];

    //             $estadioLarvalValor = EstadioLarvalValor::find($detalleChequeo->estadio_larval_valor_id);

    //             $aux = [
    //                 'estadio_larval_valor_id' => $detalleChequeo->estadio_larval_valor_id,
    //                 'nombre_estadio_valor_crecimiento' => strtoupper($estadioLarvalValor->estadio_larval->abrv) . ' - ' . $detalleChequeo->valor_crecimiento->valor
    //                 //'nombre_estadio_valor_crecimiento' => ucwords($estadioLarvalValor->estadio_larval->nombre_estadio) . ' ' . $estadioLarvalValor->valor_crecimiento->valor,
    //             ];
    //             $estadio_larval_valor[] = (object) $aux;

    //             $response = ['status' => true, 'message' => "si hay datos", 'data' => $chequeo + 1, 'estadio_larval_valor_id' => $estadio_larval_valor];

    //         } else {
    //             $response = ['status' => false, 'message' => "no existe el laboratorio", 'data' => 1, 'estadio_larval_valor_id' => null];
    //         }
    //         return response()->json($response, 200);
    //     } catch (\Throwable $th) {
    //         $response = ['status' => false, 'message' => 'Error del Servidor'];
    //         return response()->json($response, 500);
    //     }
    // }

    public function validarNumeroChequeo($laboratorio_id, $modulo_id)
    {
        try {
            $cab_chequeo = CabChequeo::where('laboratorio_id', $laboratorio_id)->where('modulo_id', $modulo_id)->where('finalizado', 'N')->where('status', 'A')->latest()->first();

            if ($cab_chequeo) {
                $chequeo = $cab_chequeo->chequeo;

                $detalleChequeo = DetalleChequeo::where('cab_chequeo_id', $cab_chequeo->id)->first();

                $estadio_larval_valor = [];

                if ($detalleChequeo) {
                    $estadioLarvalValor = EstadioLarvalValor::find($detalleChequeo->estadio_larval_valor_id);

                    if ($estadioLarvalValor) {
                        
                        $estadio_larval_Abrv = strtoupper($estadioLarvalValor->estadio_larval->abrv) . ' - ' . $estadioLarvalValor->valor_crecimiento->valor;
                        
                        $aux = [
                            'estadio_larval_valor_id' => $detalleChequeo->estadio_larval_valor_id,
                            'nombre_estadio_valor_crecimiento' => $estadio_larval_Abrv
                            //'nombre_estadio_valor_crecimiento' => ucwords($estadioLarvalValor->estadio_larval->nombre_estadio) . ' ' . $estadioLarvalValor->valor_crecimiento->valor,
                        ];
                        $estadio_larval_valor[] = (object) $aux;
                    }
                }

                $response = ['status' => true, 'message' => "si hay datos", 'data' => $chequeo + 1, 'estadio_larval_valor_id' => $estadio_larval_valor];

            } else {
                $response = ['status' => false, 'message' => "no existe el laboratorio", 'data' => 1, 'estadio_larval_valor_id' => null];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function verChequeosNoFinalizados($user_id)
    {
        try {
            $cabChequeo = CabChequeo::where('user_id', $user_id)->where('finalizado', 'N')->get();
            $response = [];

            if ($cabChequeo->count() > 0) {
                foreach ($cabChequeo as $cbch) {
                    $cbch->user->person;
                    $cbch->laboratorio;
                    $cbch->modulo;
                    $cbch->grupo;
                    $cbch->chequeo_tanque;
                    foreach ($cbch->detalle_chequeo as $detch) {
                        $detch->origen_nauplio;
                        $detch->actividad;
                        $detch->estadio_larval_valor->estadio_larval;
                        $detch->estadio_larval_valor->valor_crecimiento;
                        $detch->branquia;
                        $detch->medios_cultivo;
                    }
                    $cbch->parametro_fisico_quimico;
                    foreach ($cbch->analisis_microscopio as $ana) {
                        $ana->dieta;
                        $ana->alimentacion;
                        $ana->lipido;
                        $ana->musculo;
                    }
                }

                //$nodos = $this->chequeosNodos($user_id);

                $response = ['status' => true, 'message' => "si hay datos", 'data' => $cabChequeo ];
            } else {
                $response = ['status' => false, 'message' => "no hay datos", 'data' => $cabChequeo];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function transformToMillions($value)
    {
        $transformedValue = $value * 1000000;

        return number_format($transformedValue, 0, '.', '.'); // Formatear sin decimales y con punto como separador de miles
    }

    public function guardarChequeo(Request $request)
    {
        /* try { */
            $dataChequeo = (object) $request->data;
            $response = [];

            if ($dataChequeo) {
                $requestCabChequeo = (object) $dataChequeo->cab_chequeos;
                $requestChequeoTanque = (array) $dataChequeo->chequeo_tanques;
                $requestDetalleChequeo = (array) $dataChequeo->detalle_chequeos;
                $requestFiscoQuimico = (array) $dataChequeo->pfisicos_quimicos;
                $requestAnalisisMicro = (array) $dataChequeo->analisis_microscopio;

                $cant_millon = $this->transformToMillions(doubleval($requestCabChequeo->cantidad_reservada));


                $existeChequeo = CabChequeo::where('chequeo',$requestCabChequeo->chequeo)->where('laboratorio_id',$requestCabChequeo->laboratorio_id)->where('modulo_id',$requestCabChequeo->modulo_id) ->first();

                if ($existeChequeo) {
                    $response = ['status' => false, 'message' => "El chequeo ya se encuentra registrado"];
                } else {
                    $nuevoCabChequeo = new CabChequeo();
                    $nuevoCabChequeo->user_id = $requestCabChequeo->user_id;
                    $nuevoCabChequeo->laboratorio_id = $requestCabChequeo->laboratorio_id;
                    $nuevoCabChequeo->modulo_id = $requestCabChequeo->modulo_id;
                    $nuevoCabChequeo->grupo_id = $requestCabChequeo->grupo_id;
                    $nuevoCabChequeo->cantidad_reservada = $cant_millon;
                    $nuevoCabChequeo->fecha_siembra = $requestCabChequeo->fecha_siembra;
                    $nuevoCabChequeo->maduraciones = $requestCabChequeo->maduraciones;
                    $nuevoCabChequeo->chequeo = $requestCabChequeo->chequeo;
                    $nuevoCabChequeo->observacion_recomendacion = $requestCabChequeo->observacion_recomendacion;
                    $nuevoCabChequeo->fecha = date('Y-m-d');
                    $nuevoCabChequeo->hora = date('H:i:s');
                    $nuevoCabChequeo->finalizado = 'N';
                    $nuevoCabChequeo->status = 'A';
                    

                    if ($nuevoCabChequeo->save()) {
                        //insertar en la tabla chequeo tanques
                        foreach ($requestChequeoTanque as $gch) {
                            $newChequeoTanque = new ChequeoTanque();
                            $newChequeoTanque->cab_chequeo_id = $nuevoCabChequeo->id;
                            $newChequeoTanque->num_tanque = $gch['num_tanque'];
                            $newChequeoTanque->save();
                        }

                        // Insertar en la tabla detalle chequeos
                        foreach ($requestDetalleChequeo as $detalle) {
                            $nuevoDetalle = new DetalleChequeo();
                            // $nuevoDetalle->chequeo_tanque_id = $newChequeoTanque->id;
                            $nuevoDetalle->cab_chequeo_id = $nuevoCabChequeo->id;
                            $nuevoDetalle->tanque_anterior = $detalle['tanque_anterior'];
                            $nuevoDetalle->origen_nauplio_id = $detalle['origen_nauplio_id'];
                            $nuevoDetalle->actividad_id = $detalle['actividad_id'];
                            $nuevoDetalle->cantidad_sembrada = $this->transformToMillions(doubleval($detalle['cantidad_sembrada']));
                            $nuevoDetalle->tq_capacidad_tn = $detalle['tq_capacidad_tn'];
                            $nuevoDetalle->nivel_actual_tn = $detalle['nivel_actual_tn'];
                            $nuevoDetalle->poblacion_actual = $this->transformToMillions(doubleval($detalle['poblacion_actual']));
                            $nuevoDetalle->larvas_por_litros = $detalle['larvas_por_litros'];
                            $nuevoDetalle->dias_de_cultivo = $detalle['dias_de_cultivo'];
                            $nuevoDetalle->dias_de_post_larva = $detalle['dias_de_post_larva'];
                            $nuevoDetalle->estadio_larval_valor_id = $detalle['estadio_larval_valor_id'];
                            $nuevoDetalle->branquia_id = $detalle['branquia_id'];
                            $nuevoDetalle->pl_gr = $detalle['pl_gr'];
                            $nuevoDetalle->larvas_azuladas = $detalle['larvas_azuladas'];
                            $nuevoDetalle->bact_luminiscente = $detalle['bact_luminiscente'];
                            $nuevoDetalle->medios_cultivo_id = $detalle['medios_cultivo_id'];
                            $nuevoDetalle->save();
                        }

                        // Insertar en la tabla parametros fisicos quimicos
                        foreach ($requestFiscoQuimico as $fiscoQuimico) {
                            $nuevoDetalleFq = new ParametrosFisicoQuimico();
                            // $nuevoDetalleFq->chequeo_tanque_id = $newChequeoTanque->id;
                            $nuevoDetalleFq->cab_chequeo_id = $nuevoCabChequeo->id;
                            $nuevoDetalleFq->temperatura = $fiscoQuimico['temperatura'];
                            $nuevoDetalleFq->salinidad = $fiscoQuimico['salinidad'];
                            $nuevoDetalleFq->alcalinidad = $fiscoQuimico['alcalinidad'];
                            $nuevoDetalleFq->ph = $fiscoQuimico['ph'];
                            $nuevoDetalleFq->save();
                        }

                        // Insertar en la tabla analisis microscopio
                        foreach ($requestAnalisisMicro as $analisisMicro) {
                            $nuevoDetalleAm = new AnalisisMicroscopio();
                            // $nuevoDetalleAm->chequeo_tanque_id =$newChequeoTanque->id;
                            $nuevoDetalleAm->cab_chequeo_id = $nuevoCabChequeo->id;
                            $nuevoDetalleAm->dieta_id = $analisisMicro['dieta_id'];
                            $nuevoDetalleAm->alimentacion_id = $analisisMicro['alimentacion_id'];
                            $nuevoDetalleAm->lipido_id = $analisisMicro['lipido_id'];
                            $nuevoDetalleAm->semillenas = $analisisMicro['semillenas'];
                            $nuevoDetalleAm->estres = $analisisMicro['estres'];
                            $nuevoDetalleAm->musculo_id = $analisisMicro['musculo_id'];
                            $nuevoDetalleAm->opacidad = $analisisMicro['opacidad'];
                            $nuevoDetalleAm->necrosis = $analisisMicro['necrosis'];
                            $nuevoDetalleAm->flacidez = $analisisMicro['flacidez'];
                            $nuevoDetalleAm->bacteria_filamentosas = $analisisMicro['bacteria_filamentosas'];
                            $nuevoDetalleAm->protozoos = $analisisMicro['protozoos'];
                            $nuevoDetalleAm->hongos = $analisisMicro['hongos'];
                            $nuevoDetalleAm->save();
                        }

                        $response = ['status' => true, 'message' => "El chequeo se registró con éxito"];
                    } else {
                        $response = ['status' => false, 'message' => "El chequeo no se puede registrar"];
                    }
                }
            } else {
                $response = ['status' => false, 'message' => "No hay datos para procesar"];
            }
            return response()->json($response, 200);
        /* } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        } */
    }

    public function consultasChequeos($user_id)
    {
        try {
            $queryCabeceraChequeo = CabChequeo::where('finalizado', 'N');

            if ($user_id != -1) {
                $queryCabeceraChequeo->where('user_id', $user_id);
            }

            $cabChequeo = $queryCabeceraChequeo->get();

            $response = ['status' => $cabChequeo->isNotEmpty(), 'message' => $cabChequeo->isNotEmpty() ? 'si hay datos' : 'no hay datos', 'data' => []];

            if ($cabChequeo->isNotEmpty()) {
                foreach ($cabChequeo as $cbch) {
                    $cbch->load([
                        'user.person',
                        'laboratorio',
                        'modulo',
                        'grupo',
                        'chequeo_tanque',
                        'detalle_chequeo',
                        'detalle_chequeo.origen_nauplio',
                        'detalle_chequeo.actividad',
                        'detalle_chequeo.estadio_larval_valor.estadio_larval',
                        'detalle_chequeo.estadio_larval_valor.valor_crecimiento',
                        'detalle_chequeo.branquia',
                        'detalle_chequeo.medios_cultivo',
                        'parametro_fisico_quimico',
                        'analisis_microscopio.dieta',
                        'analisis_microscopio.alimentacion',
                        'analisis_microscopio.lipido',
                        'analisis_microscopio.musculo',
                    ]);
                }
                $response['data'] = $cabChequeo;
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function consultasChequeosPorLaboratorio($laboratorio_id)
    {
        try {
            $queryCabeceraChequeo = CabChequeo::where('finalizado', 'N');

            if ($laboratorio_id != -1) {
                $queryCabeceraChequeo->where('laboratorio_id', $laboratorio_id);
            }

            $cabChequeo = $queryCabeceraChequeo->get();

            $response = ['status' => $cabChequeo->isNotEmpty(), 'message' => $cabChequeo->isNotEmpty() ? 'si hay datos' : 'no hay datos', 'data' => []];

            if ($cabChequeo->isNotEmpty()) {
                foreach ($cabChequeo as $cbch) {
                    $cbch->load([
                        'user.person',
                        'laboratorio',
                        'modulo',
                        'grupo',
                        'chequeo_tanque',
                        'detalle_chequeo',
                        'detalle_chequeo.origen_nauplio',
                        'detalle_chequeo.actividad',
                        'detalle_chequeo.estadio_larval_valor.estadio_larval',
                        'detalle_chequeo.estadio_larval_valor.valor_crecimiento',
                        'detalle_chequeo.branquia',
                        'detalle_chequeo.medios_cultivo',
                        'parametro_fisico_quimico',
                        'analisis_microscopio.dieta',
                        'analisis_microscopio.alimentacion',
                        'analisis_microscopio.lipido',
                        'analisis_microscopio.musculo',
                    ]);
                }
                $response['data'] = $cabChequeo;
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function finalizarChequeosNoFinalizados($laboratorio_id,$modulo_id,$fecha_siembra)
    {
        try {
            $cabChequeo = CabChequeo::where('laboratorio_id', $laboratorio_id)
                        ->where('modulo_id', $modulo_id)
                        ->where(function ($query) use ($fecha_siembra) {
                            $query->whereDate('fecha_siembra', '=', $fecha_siembra)
                                  ->orWhere('fecha_siembra', 'like', $fecha_siembra . ' %');
                        })
                        ->where('finalizado', 'N')
                        ->get();
            $response = [];

            if ($cabChequeo->count() > 0) {
                foreach ($cabChequeo as $cab) {
                    $cab->finalizado = 'S';
                    $cab->save();
                }
                $response = ['status' => true, 'message' => "Los Chequeos seleccionados se finalizaron con éxito"];
            } else {
                $response = ['status' => false, 'message' => "no hay datos", 'data' => $cabChequeo];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function laboratoriosRegistrados($laboratorio_id)
    {
        try {
            $cabChequeo = CabChequeo::where('laboratorio_id', $laboratorio_id)
                        ->where('finalizado', 'N')
                        ->get();
            $response = [];  $dataModulos = [];

            if ($cabChequeo->count() > 0) {
                foreach ($cabChequeo as $cab) {
                    $aux = [
                        'modulo_id' => $cab->modulo->id,
                        'modulo' => strtoupper($cab->modulo->nombre_modulo)
                    ];
                    $dataModulos[] = (object)$aux;
                }
                // Eliminar duplicados
                $dataModulos = collect($dataModulos)->unique('modulo_id')->values()->all();

                $response = ['status' => true, 'message' => "existen datos", 'data' => $dataModulos ];
            } else {
                $response = ['status' => false, 'message' => "no hay datos", 'data' => $dataModulos];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function fechasSiembrasRegistradas($laboratorio_id,$modulo_id)
    {
        try {
            $cabChequeo = CabChequeo::where('laboratorio_id', $laboratorio_id)
                        ->where('modulo_id', $modulo_id)
                        ->where('finalizado', 'N')
                        ->get();
            $response = [];  $dataFechas = [];

            if ($cabChequeo->count() > 0) {
                foreach ($cabChequeo as $cab) {
                    $dateParts = explode(" - ", $cab->fecha_siembra);
                    $aux = [
                        'fecha_siembra' => $dateParts[0]
                    ];
                    $dataFechas[] = (object)$aux;
                }
                // Eliminar duplicados
                $dataFechas = collect($dataFechas)->unique('fecha_siembra')->values()->all();
                
                $response = ['status' => true, 'message' => "existen datos", 'data' => $dataFechas ];
            } else {
                $response = ['status' => false, 'message' => "no hay datos", 'data' => $dataFechas];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }
}
