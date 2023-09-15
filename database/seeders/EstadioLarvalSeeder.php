<?php

namespace Database\Seeders;

use App\Models\EstadioLarval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadioLarvalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataEstadioLarval = [
            ['nombre_estadio' => 'zoea','abrv'=>'zoe','status'=> 'A'],
            ['nombre_estadio' => 'mysis','abrv'=>'mys','status'=> 'A'],
            ['nombre_estadio' => 'peligramo','abrv'=>'pl','status'=> 'A'],
        ];

        foreach ($dataEstadioLarval as $del) {
            EstadioLarval::create($del);
        }
    }
}
