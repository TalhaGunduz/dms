<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MainDish;
use App\Models\SideDish;
use App\Models\Dessert;
use App\Models\Salad;
use App\Models\Beverage;
use App\Models\Soup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Önce tabloları temizle
        DB::table('daily_menus')->truncate();
        DB::table('soups')->truncate();
        DB::table('beverages')->truncate();
        DB::table('salads')->truncate();
        DB::table('desserts')->truncate();
        DB::table('side_dishes')->truncate();
        DB::table('main_dishes')->truncate();

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        // Main Dishes
        $mainDishes = [
            ['name' => 'Tavuk Sote', 'description' => 'Sebzeli tavuk sote', 'price' => 45.00, 'is_available' => true, 'calories' => 350],
            ['name' => 'Köfte', 'description' => 'Izgara köfte', 'price' => 50.00, 'is_available' => true, 'calories' => 400],
            ['name' => 'Tavuk Şiş', 'description' => 'Izgara tavuk şiş', 'price' => 48.00, 'is_available' => true, 'calories' => 320],
            ['name' => 'Pide', 'description' => 'Kıymalı pide', 'price' => 40.00, 'is_available' => true, 'calories' => 500],
            ['name' => 'Mantı', 'description' => 'El açması mantı', 'price' => 35.00, 'is_available' => true, 'calories' => 600],
        ];

        foreach ($mainDishes as $dish) {
            MainDish::create($dish);
        }

        // Side Dishes
        $sideDishes = [
            ['name' => 'Pilav', 'description' => 'Tereyağlı pilav', 'price' => 15.00, 'is_available' => true, 'calories' => 200],
            ['name' => 'Makarna', 'description' => 'Domates soslu makarna', 'price' => 15.00, 'is_available' => true, 'calories' => 220],
            ['name' => 'Patates Kızartması', 'description' => 'Çıtır patates kızartması', 'price' => 20.00, 'is_available' => true, 'calories' => 300],
            ['name' => 'Bulgur Pilavı', 'description' => 'Domatesli bulgur pilavı', 'price' => 15.00, 'is_available' => true, 'calories' => 180],
            ['name' => 'Mercimek Çorbası', 'description' => 'Geleneksel mercimek çorbası', 'price' => 15.00, 'is_available' => true, 'calories' => 120],
        ];

        foreach ($sideDishes as $dish) {
            SideDish::create($dish);
        }

        // Desserts
        $desserts = [
            ['name' => 'Sütlaç', 'description' => 'Fırın sütlaç', 'price' => 20.00, 'is_available' => true, 'calories' => 180],
            ['name' => 'Kazandibi', 'description' => 'Geleneksel kazandibi', 'price' => 20.00, 'is_available' => true, 'calories' => 200],
            ['name' => 'Baklava', 'description' => 'Fıstıklı baklava', 'price' => 25.00, 'is_available' => true, 'calories' => 250],
            ['name' => 'Künefe', 'description' => 'Antep fıstıklı künefe', 'price' => 30.00, 'is_available' => true, 'calories' => 350],
            ['name' => 'Dondurma', 'description' => 'Çeşitli dondurma', 'price' => 15.00, 'is_available' => true, 'calories' => 100],
        ];

        foreach ($desserts as $dessert) {
            Dessert::create($dessert);
        }

        // Salads
        $salads = [
            ['name' => 'Çoban Salata', 'description' => 'Klasik çoban salata', 'price' => 15.00, 'is_available' => true, 'calories' => 60],
            ['name' => 'Mevsim Salata', 'description' => 'Mevsim yeşillikleri', 'price' => 15.00, 'is_available' => true, 'calories' => 55],
            ['name' => 'Akdeniz Salata', 'description' => 'Akdeniz usulü salata', 'price' => 20.00, 'is_available' => true, 'calories' => 70],
            ['name' => 'Roka Salata', 'description' => 'Roka ve parmesan salata', 'price' => 20.00, 'is_available' => true, 'calories' => 65],
            ['name' => 'Sezar Salata', 'description' => 'Tavuklu sezar salata', 'price' => 25.00, 'is_available' => true, 'calories' => 250],
        ];

        foreach ($salads as $salad) {
            Salad::create($salad);
        }

        // Beverages
        $beverages = [
            ['name' => 'Ayran', 'description' => 'Soğuk ayran', 'price' => 10.00, 'is_available' => true, 'calories' => 60],
            ['name' => 'Kola', 'description' => 'Soğuk kola', 'price' => 15.00, 'is_available' => true, 'calories' => 140],
            ['name' => 'Su', 'description' => 'Şişe su', 'price' => 5.00, 'is_available' => true, 'calories' => 0],
            ['name' => 'Çay', 'description' => 'Sıcak çay', 'price' => 5.00, 'is_available' => true, 'calories' => 2],
            ['name' => 'Türk Kahvesi', 'description' => 'Geleneksel Türk kahvesi', 'price' => 15.00, 'is_available' => true, 'calories' => 15],
        ];

        foreach ($beverages as $beverage) {
            Beverage::create($beverage);
        }

        // Soups
        $soups = [
            ['name' => 'Mercimek Çorbası', 'description' => 'Geleneksel mercimek çorbası', 'price' => 15.00, 'is_available' => true, 'calories' => 120],
            ['name' => 'Ezogelin Çorbası', 'description' => 'Geleneksel ezogelin çorbası', 'price' => 15.00, 'is_available' => true, 'calories' => 130],
            ['name' => 'Yayla Çorbası', 'description' => 'Yoğurtlu yayla çorbası', 'price' => 15.00, 'is_available' => true, 'calories' => 110],
            ['name' => 'Tavuk Suyu Çorbası', 'description' => 'Tavuk suyu çorbası', 'price' => 15.00, 'is_available' => true, 'calories' => 90],
            ['name' => 'Düğün Çorbası', 'description' => 'Geleneksel düğün çorbası', 'price' => 15.00, 'is_available' => true, 'calories' => 140],
        ];

        foreach ($soups as $soup) {
            Soup::create($soup);
        }
    }
} 