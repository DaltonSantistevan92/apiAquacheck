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
            ['nombre_estadio' => 'zoea','status'=> 'A'],
            ['nombre_estadio' => 'mysis','status'=> 'A'],
            ['nombre_estadio' => 'peligramo','status'=> 'A'],
        ];

        foreach ($dataEstadioLarval as $del) {
            EstadioLarval::create($del);
        }
    }
}
