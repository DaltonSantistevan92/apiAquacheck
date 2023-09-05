<?php

namespace Database\Seeders;

use App\Models\Sexo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataSex = [
            ['sex' => 'masculino','status'=> 'A'],
            ['sex' => 'femenino','status'=> 'A']
        ];
    
        foreach ($dataSex as $ds) {
            Sexo::create($ds);
        }
    }
}
