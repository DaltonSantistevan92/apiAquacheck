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
            ['nauplio' => 'texcumar','abrv' => 'tex','status'=> 'A'],
            ['nauplio' => 'genomar','abrv' => 'gen','status'=> 'A'],
            ['nauplio' => 'biomar','abrv' => 'bio','status'=> 'A'],
            ['nauplio' => 'aquez','abrv' => 'aqu','status'=> 'A']
        ];

        foreach ($dataOrgienNauplio as $dorigen) {
            OrigenNauplio::create($dorigen);
        }
    }
}
