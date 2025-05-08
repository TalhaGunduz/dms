<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = [
            ['name' => 'A', 'description' => 'A Block - Male Students'],
            ['name' => 'B', 'description' => 'B Block - Female Students'],
            ['name' => 'C', 'description' => 'C Block - Staff and Visitors'],
        ];

        foreach ($blocks as $block) {
            DB::table('blocks')->insert([
                'name' => $block['name'],
                'description' => $block['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 