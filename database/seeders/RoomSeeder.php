<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Get block IDs
        $blocks = DB::table('blocks')->get();
        
        foreach ($blocks as $block) {
            // Create rooms for each floor (4 floors)
            for ($floor = 1; $floor <= 4; $floor++) {
                // Create 10 rooms per floor
                for ($roomNumber = 1; $roomNumber <= 10; $roomNumber++) {
                    $roomNo = $floor * 100 + $roomNumber; // e.g., 101, 102, ..., 401, 402
                    
                    DB::table('rooms')->insert([
                        'block_id' => $block->id,
                        'number' => (string)$roomNo,
                        'capacity' => 4, // Default capacity
                        'current_students' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
} 