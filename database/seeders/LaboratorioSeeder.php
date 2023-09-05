<?php

namespace Database\Seeders;

use App\Models\Laboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataLab = [
            ['nombre' => 'viacua', 'lugar' => 'san antonio', 'status'=> 'A']
        ];

        foreach ($dataLab as $dlab) {
            Laboratorio::create($dlab);
        }
    }
}
