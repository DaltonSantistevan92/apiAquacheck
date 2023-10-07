<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataGrupo = [
            ['nombre_grupo' => 'lanec','status'=> 'A'],
            ['nombre_grupo' => 'promarisco','status'=> 'A'],
            ['nombre_grupo' => 'aguilar','status'=> 'A'],
            ['nombre_grupo' => 'omarsa','status'=> 'A'],
            ['nombre_grupo' => 'naturisa','status'=> 'A'],
            ['nombre_grupo' => 'pescanova','status'=> 'A'],
            ['nombre_grupo' => 'p&i bravito','status'=> 'A'],
            ['nombre_grupo' => 'otros','status'=> 'A'],
        ];

        foreach ($dataGrupo as $dg) {
            Grupo::create($dg);
        }
    }
}
