<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataMenu = [
            ['id_seccion' => 0,'menu' => 'home' , 'url' => 'home', 'icono' => '#', 'posicion' => 1, 'status' => 'A'],
            ['id_seccion' => 1,'menu' => 'dashboard' , 'url' => 'dashboard', 'icono' => 'pi pi-fw pi-home', 'posicion' => 1, 'status' => 'A'],
            ['id_seccion' => 0,'menu' => 'Gestión de Chequeos' , 'url' => '', 'icono' => '#', 'posicion' => 2, 'status' => 'A'],
            ['id_seccion' => 3,'menu' => 'Chequeos' , 'url' => 'chequeo', 'icono' => 'pi pi-fw pi-check-square', 'posicion' => 1, 'status' => 'A'],
            ['id_seccion' => 0,'menu' => 'Gestión de Usuarios' , 'url' => '', 'icono' => '#', 'posicion' => 3, 'status' => 'A'],
            ['id_seccion' => 5,'menu' => 'Usuarios' , 'url' => 'usuario', 'icono' => 'pi pi-users', 'posicion' => 1, 'status' => 'A'],
            ['id_seccion' => 0,'menu' => 'Laboratorios / Módulos' , 'url' => '', 'icono' => '#', 'posicion' => 4, 'status' => 'A'],
            ['id_seccion' => 7,'menu' => 'Asignación' , 'url' => 'asignacion', 'icono' => 'pi pi-table', 'posicion' => 1, 'status' => 'A'],
            ['id_seccion' => 3,'menu' => 'Consultas' , 'url' => 'consultas', 'icono' => 'pi pi-search', 'posicion' => 2, 'status' => 'A'],

        ];
    
        foreach ($dataMenu as $dm) {
            Menu::create($dm);
        }
    }
}
