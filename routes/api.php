<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlimentacionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranquiaController;
use App\Http\Controllers\CabChequeoController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\EstadioLarvalValorController;
use App\Http\Controllers\GeolocalizacionLaboratorioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\LaboratorioModuloController;
use App\Http\Controllers\LipidoController;
use App\Http\Controllers\MediosCultivoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\MusculoController;
use App\Http\Controllers\OrigenNauplioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SexoController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

//RUTAS PUBLICAS
Route::post('login',[AuthController::class, 'iniciarSesionCedula']);  //login con cedula y password
Route::post('olvidarContrasena', [UserController::class, 'olvidarContrasenaUser']);

//RUTAS PROTEGIDAS JWT
// Grupo de rutas con el prefijo 'usuario'
Route::prefix('usuario')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [UserController::class, 'listarUsuarios']);
    Route::post('guardar', [UserController::class, 'guardarUsuario']);
    Route::post('editar', [UserController::class, 'editarUsuario']);
    Route::get('activarInactivar/{user_id}/{status}', [UserController::class, 'activarInactivarUsuarios']);
    Route::get('listarChequeadores', [UserController::class, 'listarUsuarioChequeador']);
    Route::post('cambiarContrasena', [UserController::class, 'cambiarContrasenaUser']);
});

// Grupo de rutas con el prefijo 'role'
Route::prefix('role')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [RoleController::class, 'listarRoles']);
});

// Grupo de rutas con el prefijo 'sexo'
Route::prefix('sexo')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [SexoController::class, 'listarSexo']);
});

// Grupo de rutas con el prefijo 'laboratorio'
Route::prefix('laboratorio')->middleware('jwt.verify')->group(function () {
    Route::post('guardar', [LaboratorioController::class, 'guardarLaboratorio']);
    Route::post('editar', [LaboratorioController::class, 'editarLaboratorio']);
    Route::get('listar', [LaboratorioController::class, 'listarLaboratorio']);
    Route::get('listarLabConsulta', [LaboratorioController::class, 'listarLaboratoriosConsulta']);
});

// Grupo de rutas con el prefijo 'modulo'
Route::prefix('modulo')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [ModuloController::class, 'listarModulo']);
    Route::post('guardar', [ModuloController::class, 'guardarModulo']);
    Route::post('editar', [ModuloController::class, 'editarModulo']);
});

// Grupo de rutas con el prefijo 'laboratorio_modulo'
Route::prefix('laboratorio_modulo')->middleware('jwt.verify')->group(function () {
    Route::post('asignaciones', [LaboratorioModuloController::class, 'asignacionesLabMod']);
    Route::delete('asignacionesEliminar/{laboratorio_modulo_id}', [LaboratorioModuloController::class, 'asignacionesLabModEliminar']);
    Route::get('asignacionListar', [LaboratorioModuloController::class, 'asignacionesListar']);
    Route::get('lugar/{laboratorio_id}/{modulo_id}', [LaboratorioModuloController::class, 'getLugar']);
});

// Grupo de rutas con el prefijo 'grupo'
Route::prefix('grupo')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [GrupoController::class, 'listarGrupo']);
});

// Grupo de rutas con el prefijo 'origen nauplio'
Route::prefix('origen_nauplio')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [OrigenNauplioController::class, 'listarOrigenNauplio']);
});

// Grupo de rutas con el prefijo 'actividad'
Route::prefix('actividad')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [ActividadController::class, 'listarActividad']);
});

// Grupo de rutas con el prefijo 'branquias'
Route::prefix('branquias')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [BranquiaController::class, 'listarBranquias']);
});

// Grupo de rutas con el prefijo 'medios cultivos'
Route::prefix('medio_cultivos')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [MediosCultivoController::class, 'listarMedioCultivos']);
});

// Grupo de rutas con el prefijo 'dietas'
Route::prefix('dietas')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [DietaController::class, 'listarDietas']);
});

// Grupo de rutas con el prefijo 'alimentacion'
Route::prefix('alimentacion')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [AlimentacionController::class, 'listarAlimentaciones']);
});

// Grupo de rutas con el prefijo 'lipido'
Route::prefix('lipido')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [LipidoController::class, 'listarLipidos']);
});

// Grupo de rutas con el prefijo 'musculo'
Route::prefix('musculo')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [MusculoController::class, 'listarMusculos']);
});

// Grupo de rutas con el prefijo 'chequeo'
Route::prefix('chequeo')->middleware('jwt.verify')->group(function () {
    Route::get('validarNumeroChequeo/{laboratorio_id}/{modulo_id}', [CabChequeoController::class, 'validarNumeroChequeo']);
    Route::get('verChequeosNoFinalizados/{user_id}', [CabChequeoController::class, 'verChequeosNoFinalizados']);
    Route::post('guardar', [CabChequeoController::class, 'guardarChequeo']);
    Route::get('consultaChequeo/{user_id}', [CabChequeoController::class, 'consultasChequeos']);
    Route::get('consultaChequeoLaboratorio/{laboratorio_id}', [CabChequeoController::class, 'consultasChequeosPorLaboratorio']);
    Route::get('finalizarChequeos/{laboratorio_id}/{modulo_id}/{fecha_siembra}', [CabChequeoController::class, 'finalizarChequeosNoFinalizados']);
    Route::get('laboratoriosModulosRegistrados/{laboratorio_id}', [CabChequeoController::class, 'laboratoriosRegistrados']);
    Route::get('fechaSiembraRegistradas/{laboratorio_id}/{modulo_id}', [CabChequeoController::class, 'fechasSiembrasRegistradas']);
});

// Grupo de rutas con el prefijo 'estadio_larval_valor'
Route::prefix('estadio_larval_valor')->middleware('jwt.verify')->group(function () {
    Route::get('listar', [EstadioLarvalValorController::class, 'listarEstadioLarvalValor']);
});

// Grupo de rutas con el prefijo 'archivo'
Route::prefix('archivo')->middleware('jwt.verify')->group(function () {
    Route::get('mostrarImagen/{carpeta}/{archivo}',[ ToolController::class, 'mostrarImagen']);
    Route::post('subirArchivo',[ ToolController::class, 'subirArchivo' ]);
});

// Grupo de rutas con el prefijo 'geolocalizacion laboratorio'
Route::prefix('geolocalizacion_laboratorio')->middleware('jwt.verify')->group(function () {
    Route::post('validarUbicacionLaboratorio', [GeolocalizacionLaboratorioController::class, 'validarGeolocalizacion']);
});

Route::prefix('google')->middleware(['jwt.verify', 'cors'])->group(function () {
    Route::get('obtenerUbicacion/{lat}/{lng}', [UbicacionController::class, 'obtenerUbicacion']);
});
