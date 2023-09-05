<?php

namespace Database\Seeders;

use App\Models\MediosCultivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediosCultivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataMedioCultivos = [
            ['medios' => 'limpio','abrv' => 'l','status' => 'A'],
            ['medios' => 'grumos','abrv' => 'g','status' => 'A'],
            ['medios' => 'sucio','abrv' => 's','status' => 'A'],
            ['medios' => 'poco sucio','abrv' => 'ps','status' => 'A'],
        ];

        foreach ($dataMedioCultivos as $dm) {
            MediosCultivo::create($dm);
        }
    }
}
