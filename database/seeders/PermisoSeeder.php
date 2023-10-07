<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPermiso = [
            ['role_id' => 1, 'menu_id' => 1, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 2, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 2, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 3, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 4, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 5, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 6, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 7, 'access' => 'N', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 8, 'access' => 'N', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 9, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 7, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 8, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 2, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 3, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 4, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 9, 'access' => 'S', 'status' => 'A'],

            ['role_id' => 1, 'menu_id' => 10, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 11, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 12, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 13, 'access' => 'S', 'status' => 'A'],

            ['role_id' => 2, 'menu_id' => 10, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 11, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 12, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 2, 'menu_id' => 13, 'access' => 'S', 'status' => 'A'],

            ['role_id' => 3, 'menu_id' => 10, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 11, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 12, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 13, 'access' => 'S', 'status' => 'A'],

            ['role_id' => 1, 'menu_id' => 14, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 1, 'menu_id' => 15, 'access' => 'S', 'status' => 'A'],

            ['role_id' => 3, 'menu_id' => 14, 'access' => 'S', 'status' => 'A'],
            ['role_id' => 3, 'menu_id' => 15, 'access' => 'S', 'status' => 'A'],
        ];
    
        foreach ($dataPermiso as $dp) {
            Permiso::create($dp);
        }
    }
}
