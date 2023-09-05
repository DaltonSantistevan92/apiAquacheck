<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function listarRoles(){
        try {
            $roles = Role::where('status','A')->get();
            $response = [];
    
            if ($roles->count() > 0) {
                $response = [ 'status' => true, 'message' => 'Existen roles', 'data' => $roles ];
            }else{
                $response = [ 'status' => false, 'message' => 'No existen roles', 'data' => null ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }
}
