<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPerson = [
            ['sexo_id' => 1,'identification'=> '0930287768', 'first_name' => 'dalton', 'last_name' => 'santistevan', 'cell_phone' => '0999314187', 'address' => 'salinas - pedro jose', 'status' => 'A'],
            ['sexo_id' => 1,'identification'=> '2222222222', 'first_name' => 'gabriel', 'last_name' => 'soto', 'cell_phone' => '0999999999', 'address' => 'guayaquil', 'status' => 'A'],
        ];
    
        foreach ($dataPerson as $per) {
            Person::create($per);
        }
    }
}
