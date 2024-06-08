<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->name = "Inod ganzz";
        $user->email = "donaidonat@gmail.com";
        $user->level = "admin";
        $user->password = "inodiziza"; //UNTUK LARAVEL 10 KEATAS
        $user->save();

        // untuk laravel 9 kebawah menggunakan Hash::make("value / isinya");
    }
}
