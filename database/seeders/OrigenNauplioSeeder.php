<?php

namespace Database\Seeders;

use App\Models\OrigenNauplio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrigenNauplioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataOrgienNauplio = [
            ['nauplio' => 'Texcumar','abrv' => 'tex','status'=> 'A'],
            ['nauplio' => 'Genomar','abrv' => 'gen','status'=> 'A'],
            ['nauplio' => 'Biogemar','abrv' => 'bio','status'=> 'A'],
            ['nauplio' => 'Aquest','abrv' => 'aqst','status'=> 'A'],
            ['nauplio' => 'Aquagent','abrv' => 'aqnt','status'=> 'A'],
            ['nauplio' => 'Opumarsa','abrv' => 'opu','status'=> 'A']
        ];

        foreach ($dataOrgienNauplio as $dorigen) {
            OrigenNauplio::create($dorigen);
        }
    }
}
