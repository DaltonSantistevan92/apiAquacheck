<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{Hash,Validator,Storage, Mail};
use App\Mail\SendPasswordUserMail;

class UserController extends Controller
{
    private $limitePassword = 10;

    public function listarUsuarios()
    {
        try {
            $usuarios = User::all();
            $response = [];

            if ($usuarios->count() > 0) {

                foreach ($usuarios as $u) {
                    $u->role;
                    $u->person;
                }

                $response = ['status' => true, 'message' => 'Existen datos', 'data' => $usuarios];
            } else {
                $response = ['status' => false, 'message' => 'No existen datos', 'data' => null];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function generate_key($limit)
    {
        $key = '';

        $aux = sha1(md5(time()));
        $key = substr($aux, 0, $limit);

        return $key;
    }

    public function guardarUsuario(Request $request)
    {
        try {
            $requestPerson = collect($request->persona)->all();
            $requestUser = collect($request->usuario)->all();

            $validatePersona = $this->validatePerson($requestPerson);
            $validateUser = $this->validateUser($requestUser);

            $response = [];

            if ($validatePersona['status'] == true && $validateUser['status'] == true) {
                $responsePerson = $this->savePerson($requestPerson);
                $person_id = $responsePerson["persona"]->id;

                $nombreCompleto = ucwords($responsePerson["persona"]->first_name) . ' ' . ucwords($responsePerson["persona"]->last_name);

                $cedula = $responsePerson["persona"]->identification;

                $keyCode = $this->generate_key($this->limitePassword); //enviar clave correo

                $encriptarPassword = Hash::make($keyCode);

                $user = User::create([
                    'role_id' => $requestUser['role_id'],
                    'person_id' => $person_id,
                    'name' => $requestUser['name'],
                    'email' => $requestUser['email'],
                    'password' => $encriptarPassword,
                    'image' => $requestUser['image'],
                    'status' => 'A',
                ]);

                $this->enviarEmail($requestUser['email'], $cedula, $keyCode, $nombreCompleto); //return

                $response = ['status' => true, 'message' => "El usuario se registró con éxito"];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'No se pudo crear el usuario',
                    'fails' => [
                        'error_person' => $validatePersona["error"] ?? "No presenta errores",
                        'error_user' => $validateUser["error"] ?? "No presenta errores",
                    ],
                ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function enviarEmail($email, $usuario, $password, $name){
        Mail::to($email)->send(new SendPasswordUserMail($email, $usuario, $password, $name));
        return;
    }

    public function savePerson($data)
    {
        $people = Person::create($data);
        $response = [];

        if ($people) {
            return $response = ['status' => true, 'message' => 'Se creó el registro correctamente', 'persona' => $people];
        } else {
            return $response = ['status' => false, 'message' => 'No se pudo guardar el registro'];
        }
        return $response;
    }

    private function validateUser($request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
        ];

        $messages = [
            'email.required' => 'El correo es requerido',
            'email.unique' => 'El correo ya ha sido registrado',
        ];
        return $this->validation($request, $rules, $messages);
    }

    private function validatePerson($request)
    {
        $rules = [
            'identification' => 'required|unique:persons,identification',
        ];

        $messages = [
            'identification.required' => 'La cédula es requerido',
            'identification.unique' => 'La cédula ya existe en nuestros registros',
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

    public function editarUsuario(Request $request)
    {
        try {
            $requestPerson = collect($request->persona)->all();
            $requestUser = collect($request->usuario)->all();

            $userDefault = 'user-default.jpg';
            $chequeadorDefault = 'chequeador-default.jpeg';
            $response = [];

            // Verifica si el nuevo correo electrónico ya existe en otros usuarios
            $existingUser = User::where('email', $requestUser['email'])->where('id', '<>', $requestUser['user_id'])->first();

            if ($existingUser) {
                return $response = ['status' => false, 'message' => "El correo electrónico ya está registrado en otro usuario"];
                //return response()->json($response, 200); 
            }

            $usuario = User::find($requestUser['user_id']);
            
            if ($usuario) {
                $persona_id = intval($usuario->person->id);

                $imagenAnterior = $usuario->image; // Guarda la imagen anterior para su posterior eliminación

                $usuario->role_id = $requestUser['role_id'];

                $usuario->email = $requestUser['email'];

                 // Verifica si la nueva imagen es diferente de la imagen anterior
                if ($requestUser['image'] != $imagenAnterior) {

                    // Verifica si la imagen anterior es diferente de las imágenes predeterminadas
                    if ($imagenAnterior != $userDefault && $imagenAnterior != $chequeadorDefault) {
                        // Eliminar la imagen anterior del disco 'usuarios'
                        Storage::disk('usuarios')->delete($imagenAnterior);
                    }

                    // Verifica si la nueva imagen es diferente de las imágenes predeterminadas
                    if ($requestUser['image'] != $userDefault && $requestUser['image'] != $chequeadorDefault) {
                        $usuario->image = $requestUser['image'];
                    } else {
                        $usuario->image = $requestUser['image'];
                    }
                } 
            
                $persona = Person::find($persona_id);
                $persona->sexo_id = $requestPerson['sexo_id'];
                $persona->first_name = $requestPerson['first_name'];
                $persona->last_name = $requestPerson['last_name'];
                $persona->cell_phone = $requestPerson['cell_phone'];
                $persona->address = $requestPerson['address'];

                $persona->save();
                $usuario->save();

                $response = ['status' => true, 'message' => "El usuario se actualizo con éxito"];
            } else {
                $response = ['status' => false, 'message' => "El usuario no existe"];
            }
            return response()->json($response, 200);  
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function activarInactivarUsuarios($user_id, $status)
    {
        try {
            $user_id = intval($user_id);
            $response = [];

            $user = User::find($user_id);
            $persona_id = $user->person_id;

            if ($user) {
                $user->status = $status;
                $personData = Person::find($persona_id);
                $personData->status = $status;
                $personData->save();
                $user->save();

                $message = $status === 'A' ? 'Se ha activado el usuario' : 'Se ha desactivado el usuario';
                $response = ['status' => true, 'message' => $message . ' ' . ucwords($personData->first_name) . ' ' . ucwords($personData->last_name), 'data' => $user->status];
            } else {
                $response = ['status' => false, 'message' => 'No existen datos'];
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function listarUsuarioChequeador()
    {
        try {
            $chequeadorRol = 2;
            $chequeadores = User::where('role_id',$chequeadorRol)->where('status','A')->get();
            $response = [];
            $chequeador = [];

            if ($chequeadores->count() > 0) {

                foreach ($chequeadores as $u) {
                    $aux = [
                        'user_id' => $u->id,
                        'chequeador' => ucwords($u->person->first_name) . ' ' . ucwords($u->person->last_name) 
                    ];
                    $chequeador[] = (object)$aux; 
                }

                $response = ['status' => true, 'message' => 'Existen datos', 'data' => $chequeador];
            } else {
                $response = ['status' => false, 'message' => 'No existen datos', 'data' => null];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }

    public function cambiarContrasenaUser(Request $request){
        try {
            $requestUser = (object) $request->update_password;
            $response  = [];

            if ($requestUser) {
                $dataUser = User::find($requestUser->user_id);
                
                if ($dataUser) {
                    if ($dataUser->status == 'A' && $dataUser->email === $requestUser->email) {
                        $encriptarPassword = Hash::make($requestUser->password);

                        $dataUser->password = $encriptarPassword;
                        $dataUser->save();
                        
                        $response = ['status' => true, 'message' => 'Se actualizó la contraseña con éxito'];
                    } else {
                        $response = ['status' => false, 'message' => 'No se pudo actualizar la contraseña'];
                    }                    
                } 
            } else {
                $response = ['status' => false, 'message' => 'No existe el usuario'];
            }
            return response()->json($response); die();
        } catch (\Throwable $th) {
            $response = ['status' => false, 'message' => 'Error del Servidor'];
            return response()->json($response, 500);
        }
    }
}
