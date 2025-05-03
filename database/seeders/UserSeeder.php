<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Yeni bir kullanıcı oluştur
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('123'), // Şifreyi bcrypt ile hash'le
            'status' => '1', // Status alanını ekleyin
        ]);
    }
}
