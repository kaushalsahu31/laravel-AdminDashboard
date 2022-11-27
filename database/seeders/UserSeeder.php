<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => "adminuser",
            'email' => 'adminuser@gmail.com',
            'gender' => 'male',
            'phone' => '0000000000',
            'image' => '',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}
