<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name'       => 'Yared Badillo',
            'email'      => 'dueno@badillogym.com',
            'password'   => Hash::make('badillo123'),
            'rol'        => 'dueno',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}