<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Validator};
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    private $permisoCtrl;


    public function __construct()
    {
        $this->permisoCtrl = new PermisoController();
    }
    
    public function iniciarSesionCedula(Request $request){
        try {
            $requestUser = collect($request)->all();
            $validateUser  = $this->validateUserNamePassword( $requestUser );
            $response = [];

            if ( $validateUser['status'] ) {
                // Obtener el usuario por el correo electrónico
                $user = User::where('name', $requestUser['name'])->where('status','A')->get()->first();

                // Verificar si el usuario existe
                if ($user != null) {
                    $user->role;   $user->person->sexo;
                    $nombreCompletoUser = '';

                    // Verificar la contraseña manualmente
                    if (!Hash::check($request['password'], $user->password)) {
                       return $response = ['status' => false, 'message' => 'La contraseña proporcionada no coincide con nuestros registros'];
                    }

                    //recupero los menus de cada rol
                    $menu = $this->permisoCtrl->permisos($user->role->id);

                    $payload = ['user' => $user, 'menu' => $menu];

                    $nombreCompletoUser = $user->person->first_name . ' ' .  $user->person->last_name; 
                    //$token = JWTAuth::claims($payload)->attempt($request->only(['email','password']));
                    $token = JWTAuth::customClaims($payload)->fromUser($user);

                    return $response = [ 'status' => true, 'message' => 'Bienvenido ' . ucwords($nombreCompletoUser) . ' a AppCheck', 'token' => $token ];
                } else {
                    return $response = ['status' => false, 'message' => 'El usuario proporcionado no coincide con nuestros registros o Usuario Inactivo'];
                }  
            } else {
                return $response = $validateUser;
            }
            return response()->json($response);  
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    private function validateUserNamePassword( $request ){ 
        $rules = [
            'name' => 'required',
            'password' => 'required|string|min:6',
        ];

        $messages = [
            'name.required' => 'El usuario es requerido',
            'password.required' => 'El campo contraseña es requerido',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres'

        ];
        return $this->validation( $request, $rules, $messages );
    }

    private function validation( $request, $rules, $messages ){
        $response = [ 'status' => true, 'message' => 'No hubo errores' ];

        $validate = Validator::make( $request, $rules, $messages ); 

        if ( $validate->fails() ) {
            $response = [ 'status' => false, 'message' => 'Error de validación', 'error' => $validate->errors() ];
        }
        return $response;
    }
}
