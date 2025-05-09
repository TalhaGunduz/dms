<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
    */
    public function run(): void
    {
        // Önce tüm tabloları temizle
        Schema::disableForeignKeyConstraints();
        
        // Sıralı bir şekilde tabloları temizle
        $tables = [
            'role_permissions',
            'user_roles',
            'permissions',
            'roles',
            'users',
            'student_entries',
            'student_room',
            'students',
            'rooms',
            'blocks',
            'payment_receipts',
            'payments',
            'payment_items',
            'payment_types',
            'daily_menus',
            'soups',
            'beverages',
            'salads',
            'desserts',
            'side_dishes',
            'main_dishes',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        // Sadece gerekli seed'ler çağrılıyor
        $this->call([
            FoodSeeder::class,
            BlockSeeder::class,
            PaymentTypeSeeder::class,
            PaymentItemSeeder::class,
            UserSeeder::class,
        ]);
    }
}
