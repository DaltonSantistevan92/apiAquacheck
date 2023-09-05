<?php

namespace Database\Seeders;

use App\Models\LaboratorioModulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratorioModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataLabModulo = [
            ['laboratorio_id' => '1','modulo_id'=> '1'],
            ['laboratorio_id' => '1','modulo_id'=> '2'],
            ['laboratorio_id' => '1','modulo_id'=> '3'],
        ];

        foreach ($dataLabModulo as $dm) {
            LaboratorioModulo::create($dm);
        }
    }
}
