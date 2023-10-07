<?php

namespace Database\Seeders;

use App\Models\Alimentacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlimentacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataAlimentacion = [
            ['nombre_alimentacion' => 'baja','status'=> 'A'],
            ['nombre_alimentacion' => 'regular','status'=> 'A'],
            ['nombre_alimentacion' => 'buena','status'=> 'A'],
            ['nombre_alimentacion' => 'excelente','status'=> 'A'],
        ];

        foreach ($dataAlimentacion as $da) {
            Alimentacion::create($da);
        }
    }
}
