<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Block;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
    */
    public function run(): void
    {
        // Kullanıcı oluşturma
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password') // Şifreyi hash'li şekilde kaydediyoruz
        ]);

        // BlockSeeder'ı çağırıyoruz
        Block::create(['name' => 'A']);
        Block::create(['name' => 'B']);
        Block::create(['name' => 'C']);
    }
}
