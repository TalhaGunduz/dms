<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
    */
    public function run(): void
    {
        DB::table('rooms')->truncate();
        DB::table('blocks')->truncate();
        DB::table('blocks')->insert([
            ['name' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'C', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
