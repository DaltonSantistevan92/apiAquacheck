<?php

namespace Database\Seeders;

use App\Models\ValorCrecimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValorCrecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataValor = [
            ['valor' => '1','status'=> 'A'],
            ['valor' => '2','status'=> 'A'],
            ['valor' => '3','status'=> 'A'],
            ['valor' => '4','status'=> 'A'],
            ['valor' => '5','status'=> 'A'],
            ['valor' => '6','status'=> 'A'],
            ['valor' => '7','status'=> 'A'],
            ['valor' => '8','status'=> 'A'],
            ['valor' => '9','status'=> 'A'],
            ['valor' => '10','status'=> 'A'],
            ['valor' => '11','status'=> 'A'],
            ['valor' => '12','status'=> 'A'],
            ['valor' => '13','status'=> 'A'],
            ['valor' => '14','status'=> 'A'],
            ['valor' => '15','status'=> 'A'],
            ['valor' => '16','status'=> 'A'],
            ['valor' => '17','status'=> 'A'],
            ['valor' => '18','status'=> 'A'],
            ['valor' => '19','status'=> 'A'],
            ['valor' => '20','status'=> 'A'],
            ['valor' => '21','status'=> 'A'],
            ['valor' => '22','status'=> 'A'],
            ['valor' => '23','status'=> 'A'],
            ['valor' => '24','status'=> 'A'],
            ['valor' => '25','status'=> 'A']
        ];

        foreach ($dataValor as $dv) {
            ValorCrecimiento::create($dv);
        }
    }
}
