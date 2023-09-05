<?php

namespace Database\Seeders;

use App\Models\Musculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataMusculo = [
            ['detalle' => '1-2','status'=> 'A'],
            ['detalle' => '2-3','status'=> 'A'],
            ['detalle' => '3-4','status'=> 'A'],
            ['detalle' => '4-5','status'=> 'A'],
        ];

        foreach ($dataMusculo as $dmu) {
            Musculo::create($dmu);
        }
    }
}
