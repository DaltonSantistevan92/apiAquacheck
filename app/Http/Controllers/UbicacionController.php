<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request; // Importación de Http

use Illuminate\Support\Facades\Http;

class UbicacionController extends Controller
{
    public function obtenerUbicacion($lat, $lng)
    {
        $apiKey = config('services.google.api_key');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$apiKey}";


        
        try {
            // Realizar la solicitud HTTP a la API de Google Maps
            $response = Http::get($url);
            //return response()->json($response, 200); die;



            // Verificar si la solicitud tuvo éxito
            if ($response->successful()) {
                $data = $response->json();



                // Verificar si la respuesta contiene resultados válidos
                if ($data['status'] === 'OK' && isset($data['results']) && count($data['results']) > 0) {
                    // Aquí puedes realizar más validaciones o manipulaciones con los datos recibidos
                    return response()->json(['ubicacion' => $data['results']], 200);
                } else {
                    return response()->json(['error' => 'No se encontraron resultados válidos'], 400);
                }
            } else {
                return response()->json(['error' => 'Error al realizar la solicitud a la API de Google Maps'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

}
