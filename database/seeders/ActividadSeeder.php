<?php

namespace Database\Seeders;

use App\Models\Actividad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataActividad = [
            ['actividad' => 'buena','status'=> 'A'],
            ['actividad' => 'muy buena','status'=> 'A'],
            ['actividad' => 'excelente','status'=> 'A'],
        ];

        foreach ($dataActividad as $da) {
            Actividad::create($da);
        }
    }
}
