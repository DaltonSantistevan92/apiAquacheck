<?php

namespace Database\Seeders;

use App\Models\GeolocalizacionLaboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeolocalizacionLaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataLabG = [
            ['laboratorio_id' => '1','latitud' => '-1.8704874','longitud' => '-80.7362711'],
            ['laboratorio_id' => '1','latitud' => '-1.8705071','longitud' => '-80.7388229'],
        ];

        foreach ($dataLabG as $dlab) {
            GeolocalizacionLaboratorio::create($dlab);
        }
    }
}
