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

        // Blokları ekle (eğer yoksa)
        if (DB::table('blocks')->count() === 0) {
            DB::table('blocks')->insert([
                ['name' => 'A', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'B', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'C', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // Sıralı bir şekilde seeder'ları çalıştır
        $this->call([
            RoleSeeder::class,        // Önce rolleri oluştur
            PermissionSeeder::class,  // Sonra izinleri oluştur
            UserSeeder::class,        // Kullanıcıları oluştur
            BlockSeeder::class,       // Blokları oluştur
            RoomSeeder::class,        // Odaları oluştur
            StudentSeeder::class,     // Öğrencileri oluştur
            PaymentTypeSeeder::class, // Ödeme tiplerini oluştur
            PaymentItemSeeder::class, // Ödeme kalemlerini oluştur
            FoodSeeder::class,        // Yemek menüsünü oluştur
        ]);
    }
}
