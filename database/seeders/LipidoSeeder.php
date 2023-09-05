<?php

namespace Database\Seeders;

use App\Models\Lipido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LipidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataLipidos = [
            ['valor_lipido' => '3/5','status'=> 'A'],
            ['valor_lipido' => '4/5','status'=> 'A'],
            ['valor_lipido' => '5/5','status'=> 'A'],
        ];

        foreach ($dataLipidos as $dl) {
            Lipido::create($dl);
        }
    }
}
