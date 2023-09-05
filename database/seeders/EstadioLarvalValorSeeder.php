<?php

namespace Database\Seeders;

use App\Models\EstadioLarvalValor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadioLarvalValorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataEstadioLarvalValor = [
            ['estadio_larval_id' => '1','valor_crecimiento_id'=> '1'],
            ['estadio_larval_id' => '1','valor_crecimiento_id'=> '2'],
            ['estadio_larval_id' => '1','valor_crecimiento_id'=> '3'],
            ['estadio_larval_id' => '2','valor_crecimiento_id'=> '1'],
            ['estadio_larval_id' => '2','valor_crecimiento_id'=> '2'],
            ['estadio_larval_id' => '2','valor_crecimiento_id'=> '3'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '1'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '2'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '3'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '4'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '5'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '6'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '7'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '8'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '9'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '10'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '11'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '12'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '13'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '14'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '15'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '16'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '17'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '18'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '19'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '20'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '21'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '22'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '23'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '24'],
            ['estadio_larval_id' => '3','valor_crecimiento_id'=> '25'],
        ];

        foreach ($dataEstadioLarvalValor as $delv) {
            EstadioLarvalValor::create($delv);
        }
    }
}
