<?php


// database/seeders/BlockSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    public function run()
    {
        // 3 blok ekliyoruz: A, B, C
        Block::create(['name' => 'A']);
        Block::create(['name' => 'B']);
        Block::create(['name' => 'C']);
    }
}
