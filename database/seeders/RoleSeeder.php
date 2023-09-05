<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataRole = [
            ['role' => 'administrador','status'=> 'A'],
            ['role' => 'chequeador','status'=> 'A']
        ];
    
        foreach ($dataRole as $dr) {
            Role::create($dr);
        }
    }
}
