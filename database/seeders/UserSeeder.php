<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataUser = [
            ['person_id' => 1, 'role_id'=> 1, 'name' => '0930287768', 'email' => 'daltonskaterboard@gmail.com', 'password' =>  Hash::make('admin'), 'image' => 'user-default.jpg', 'status' => 'A'],
            ['person_id' => 2, 'role_id'=> 2, 'name' => '2222222222', 'email' => 'gabrielsoto@gmail.com', 'password' => Hash::make('chequeador'), 'image' => 'chequeador-default.jpeg', 'status' => 'A'],
        ];

        foreach ($dataUser as $us) {
            User::create($us);
        }
    }
}
