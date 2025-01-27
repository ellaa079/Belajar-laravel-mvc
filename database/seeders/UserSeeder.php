<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Admin aplikasi',
            'level' => 'admin',
            'email' => 'mbaellaa67@gmail.com',
            'password' => bcrypt ('12345'), 
            'remember_token' => Str::random(60),
        ]);
    }
}
