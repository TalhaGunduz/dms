<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Student permissions
            ['name' => 'view_students', 'description' => 'Can view students'],
            ['name' => 'create_students', 'description' => 'Can create students'],
            ['name' => 'edit_students', 'description' => 'Can edit students'],
            ['name' => 'delete_students', 'description' => 'Can delete students'],
            
            // Room permissions
            ['name' => 'view_rooms', 'description' => 'Can view rooms'],
            ['name' => 'create_rooms', 'description' => 'Can create rooms'],
            ['name' => 'edit_rooms', 'description' => 'Can edit rooms'],
            ['name' => 'delete_rooms', 'description' => 'Can delete rooms'],
            
            // Payment permissions
            ['name' => 'view_payments', 'description' => 'Can view payments'],
            ['name' => 'create_payments', 'description' => 'Can create payments'],
            ['name' => 'edit_payments', 'description' => 'Can edit payments'],
            ['name' => 'delete_payments', 'description' => 'Can delete payments'],
            
            // Food permissions
            ['name' => 'view_food', 'description' => 'Can view food items'],
            ['name' => 'create_food', 'description' => 'Can create food items'],
            ['name' => 'edit_food', 'description' => 'Can edit food items'],
            ['name' => 'delete_food', 'description' => 'Can delete food items'],
            
            // User management permissions
            ['name' => 'view_users', 'description' => 'Can view users'],
            ['name' => 'create_users', 'description' => 'Can create users'],
            ['name' => 'edit_users', 'description' => 'Can edit users'],
            ['name' => 'delete_users', 'description' => 'Can delete users'],
            
            // Role management permissions
            ['name' => 'view_roles', 'description' => 'Can view roles'],
            ['name' => 'create_roles', 'description' => 'Can create roles'],
            ['name' => 'edit_roles', 'description' => 'Can edit roles'],
            ['name' => 'delete_roles', 'description' => 'Can delete roles'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'description' => $permission['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 