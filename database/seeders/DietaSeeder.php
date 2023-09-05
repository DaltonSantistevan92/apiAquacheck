<?php

namespace Database\Seeders;

use App\Models\Dieta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataDieta = [
            ['nombre_dieta' => 'biomar','abrv' => 'bio','status'=> 'A'],
            ['nombre_dieta' => 'inve','abrv' => 'inv','status'=> 'A'],
            ['nombre_dieta' => 'carguil','abrv' => 'car','status'=> 'A'],
            ['nombre_dieta' => 'epicor','abrv' => 'epi','status'=> 'A'],
            ['nombre_dieta' => 'varios','abrv' => 'var','status'=> 'A'],
        ];

        foreach ($dataDieta as $ddi) {
            Dieta::create($ddi);
        }
    }
}
