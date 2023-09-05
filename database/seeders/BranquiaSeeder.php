<?php

namespace Database\Seeders;

use App\Models\Branquia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranquiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataBranquia = [
            ['nombre_branquia' => 'definido','status'=> 'A'],
            ['nombre_branquia' => 'no definido','status'=> 'A'],
        ];

        foreach ($dataBranquia as $db) {
            Branquia::create($db);
        }
    }
}
