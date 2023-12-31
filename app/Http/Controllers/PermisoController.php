<?php

namespace App\Http\Controllers;

use App\Models\{Permiso,Menu};
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    
    public function permisos($rol_id){
        try {
            $response = [];
            $permisos = Permiso::where('role_id',intval($rol_id))->where('access','S')->get();

            if ( $permisos->count() > 0 ) {
                $menusPadres = [];  $menusHijos = [];  $menusPadresOrdenadosAccesos = [];  $menuFinal = [];
    
                $bdMenusPadres = Menu::where('id_seccion', 0)->where('status','A')->orderBy('posicion')->get();

                //Separar menus padres de hijos que tienen acceso
                foreach($permisos as $item){
                    $aux = [
                        'id' => $item->menu->id,
                        'nombre' => $item->menu->menu,
                        'icono' => $item->menu->icono,
                        'url' => $item->menu->url,
                        'id_seccion' => $item->menu->id_seccion
                    ];

                    if ($item->menu->id_seccion == 0) {//id_seccion 0 es padre
                        $menusPadres[] = $aux;
                    }else{//id_seccion diferente de 0 es menu hijo
                        $menusHijos[] = $aux;
                    }
                }

                //Ordenar los menus padres solo con acceso
                foreach ($bdMenusPadres as $ordenados) {
                    foreach ($menusPadres as $desorden) {
                        if ($ordenados->id === $desorden['id']) {
                            $menusPadresOrdenadosAccesos[] = (object) $desorden;
                        }
                    }
                }

                foreach ($menusPadresOrdenadosAccesos as $padre) {
                    $menus_hijos_ordenados = Menu::where('status', 'A')->where('id_seccion', $padre->id)->orderBy('posicion')->get();

                    $hijos_ordenados = [];
                    $auxFinal['id'] = $padre->id;
                    $auxFinal['nombre'] = $padre->nombre;
                    $auxFinal['icono'] = $padre->icono;
                    $auxFinal['url'] = $padre->url;

                    if (count($menus_hijos_ordenados) > 0) {
                        foreach ($menus_hijos_ordenados as $ordenado) {
                            foreach ($menusHijos as $desorden) {
                                if ($desorden['id'] === $ordenado->id) {
                                    $hijos_ordenados[] = (object) $desorden;
                                }
                            }
                        }
                        $auxFinal['menus_hijos'] = $hijos_ordenados;
                    } else {
                        $auxFinal['menus_hijos'] = [];
                    }
                    $menuFinal[] = $auxFinal;
                }

                $response = [ 'status' => true, 'message' => 'Hay información', 'data' => $menuFinal ];                        
            }else{
                $response = [ 'status' => false, 'message' => 'No hay menus para el rol', 'data' => [] ];
            }
            return $response['data'];
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        } 
    }
}
