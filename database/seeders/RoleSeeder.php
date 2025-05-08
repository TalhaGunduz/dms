<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin rolünü oluştur
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'description' => 'Sistem yöneticisi'
        ]);

        // Admin kullanıcısına admin rolünü ata
        $admin = User::where('email', 'admin@example.com')->first();
        if ($admin) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
} 