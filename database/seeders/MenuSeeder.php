<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MainDish;
use App\Models\SideDish;
use App\Models\Dessert;
use App\Models\Salad;
use App\Models\Beverage;
use App\Models\Soup;
use App\Models\DailyMenu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Ana Yemekler
        $mainDishes = [
            ['name' => 'Izgara Köfte', 'calories' => 350, 'is_vegetarian' => false],
            ['name' => 'Tavuk Şiş', 'calories' => 280, 'is_vegetarian' => false],
            ['name' => 'Sebzeli Güveç', 'calories' => 220, 'is_vegetarian' => true],
            ['name' => 'Etli Pide', 'calories' => 400, 'is_vegetarian' => false],
            ['name' => 'Mantarlı Risotto', 'calories' => 300, 'is_vegetarian' => true],
        ];

        foreach ($mainDishes as $dish) {
            MainDish::create($dish);
        }

        // Yan Yemekler
        $sideDishes = [
            ['name' => 'Pilav', 'calories' => 180, 'is_vegetarian' => true],
            ['name' => 'Patates Püresi', 'calories' => 150, 'is_vegetarian' => true],
            ['name' => 'Bulgur Pilavı', 'calories' => 160, 'is_vegetarian' => true],
            ['name' => 'Sebze Sote', 'calories' => 120, 'is_vegetarian' => true],
            ['name' => 'Makarna', 'calories' => 200, 'is_vegetarian' => true],
        ];

        foreach ($sideDishes as $dish) {
            SideDish::create($dish);
        }

        // Tatlılar
        $desserts = [
            ['name' => 'Sütlaç', 'calories' => 220, 'is_vegetarian' => true],
            ['name' => 'Baklava', 'calories' => 350, 'is_vegetarian' => true],
            ['name' => 'Kazandibi', 'calories' => 280, 'is_vegetarian' => true],
            ['name' => 'Meyve', 'calories' => 80, 'is_vegetarian' => true],
            ['name' => 'Puding', 'calories' => 180, 'is_vegetarian' => true],
        ];

        foreach ($desserts as $dessert) {
            Dessert::create($dessert);
        }

        // Salatalar
        $salads = [
            ['name' => 'Mevsim Salatası', 'calories' => 80, 'is_vegetarian' => true],
            ['name' => 'Çoban Salatası', 'calories' => 70, 'is_vegetarian' => true],
            ['name' => 'Roka Salatası', 'calories' => 50, 'is_vegetarian' => true],
            ['name' => 'Havuç Salatası', 'calories' => 60, 'is_vegetarian' => true],
            ['name' => 'Mercimek Salatası', 'calories' => 120, 'is_vegetarian' => true],
        ];

        foreach ($salads as $salad) {
            Salad::create($salad);
        }

        // İçecekler
        $beverages = [
            ['name' => 'Ayran', 'calories' => 80, 'is_hot' => false],
            ['name' => 'Çay', 'calories' => 0, 'is_hot' => true],
            ['name' => 'Meyve Suyu', 'calories' => 120, 'is_hot' => false],
            ['name' => 'Su', 'calories' => 0, 'is_hot' => false],
            ['name' => 'Limonata', 'calories' => 100, 'is_hot' => false],
        ];

        foreach ($beverages as $beverage) {
            Beverage::create($beverage);
        }

        // Çorbalar
        $soups = [
            ['name' => 'Mercimek Çorbası', 'calories' => 120, 'is_vegetarian' => true],
            ['name' => 'Ezogelin Çorbası', 'calories' => 130, 'is_vegetarian' => true],
            ['name' => 'Tavuk Çorbası', 'calories' => 150, 'is_vegetarian' => false],
            ['name' => 'Yayla Çorbası', 'calories' => 140, 'is_vegetarian' => true],
            ['name' => 'Domates Çorbası', 'calories' => 100, 'is_vegetarian' => true],
        ];

        foreach ($soups as $soup) {
            Soup::create($soup);
        }

        // Örnek Günlük Menü
        DailyMenu::create([
            'menu_date' => now(),
            'main_dish_id' => 1,
            'side_dish_id' => 1,
            'dessert_id' => 1,
            'salad_id' => 1,
            'beverage_id' => 1,
            'soup_id' => 1,
            'meal_type' => 'lunch',
            'notes' => 'Örnek öğle yemeği menüsü',
            'created_by' => 1
        ]);
    }
} 