<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataModulo = [
            ['nombre_modulo' => 'modulo a','status'=> 'A'],
            ['nombre_modulo' => 'modulo b','status'=> 'A'],
            ['nombre_modulo' => 'modulo c','status'=> 'A'],
            ['nombre_modulo' => 'modulo d','status'=> 'A'],
        ];

        foreach ($dataModulo as $dm) {
            Modulo::create($dm);
        }
    }
}
