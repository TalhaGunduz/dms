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
            [
                'name' => 'Tavuk Sote',
                'description' => 'Sebzeli tavuk sote, taze baharatlar ile',
                'calories' => 350,
                'is_vegetarian' => false,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Izgara Köfte',
                'description' => 'El yapımı ızgara köfte, özel baharatlar ile',
                'calories' => 400,
                'is_vegetarian' => false,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Sebzeli Güveç',
                'description' => 'Fırında pişmiş mevsim sebzeleri güveç',
                'calories' => 280,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Karnıyarık',
                'description' => 'Geleneksel kıymalı patlıcan yemeği',
                'calories' => 320,
                'is_vegetarian' => false,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Mantı',
                'description' => 'El açması mantı, yoğurt ve domates sos ile',
                'calories' => 450,
                'is_vegetarian' => false,
                'is_hot' => true,
                'is_active' => true
            ]
        ];

        foreach ($mainDishes as $dish) {
            MainDish::create($dish);
        }

        // Side Dishes
        $sideDishes = [
            [
                'name' => 'Pirinç Pilavı',
                'description' => 'Tereyağlı pirinç pilavı',
                'calories' => 200,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Fırın Patates',
                'description' => 'Baharatlı fırın patates',
                'calories' => 180,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Sebzeli Bulgur Pilavı',
                'description' => 'Sebzeli ve baharatlı bulgur pilavı',
                'calories' => 220,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Zeytinyağlı Fasulye',
                'description' => 'Zeytinyağlı taze fasulye',
                'calories' => 150,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ]
        ];

        foreach ($sideDishes as $dish) {
            SideDish::create($dish);
        }

        // Desserts
        $desserts = [
            [
                'name' => 'Sütlaç',
                'description' => 'Fırında pişmiş geleneksel sütlaç',
                'calories' => 280,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Kazandibi',
                'description' => 'Geleneksel kazandibi tatlısı',
                'calories' => 320,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ],
            [
                'name' => 'Baklava',
                'description' => 'Antep fıstıklı baklava',
                'calories' => 420,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ],
            [
                'name' => 'Kemalpaşa',
                'description' => 'Şerbetli kemalpaşa tatlısı',
                'calories' => 350,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ]
        ];

        foreach ($desserts as $dessert) {
            Dessert::create($dessert);
        }

        // Salads
        $salads = [
            [
                'name' => 'Çoban Salata',
                'description' => 'Domates, salatalık, biber ve soğan ile klasik çoban salata',
                'calories' => 120,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ],
            [
                'name' => 'Mevsim Salata',
                'description' => 'Mevsim yeşillikleri ile hazırlanan salata',
                'calories' => 100,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ],
            [
                'name' => 'Roka Salata',
                'description' => 'Roka, cherry domates ve parmesan peyniri ile',
                'calories' => 130,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ],
            [
                'name' => 'Ton Balıklı Salata',
                'description' => 'Ton balığı, mısır ve yeşillikler ile',
                'calories' => 220,
                'is_vegetarian' => false,
                'is_hot' => false,
                'is_active' => true
            ]
        ];

        foreach ($salads as $salad) {
            Salad::create($salad);
        }

        // Beverages
        $beverages = [
            [
                'name' => 'Ayran',
                'description' => 'Taze ayran',
                'calories' => 60,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ],
            [
                'name' => 'Türk Kahvesi',
                'description' => 'Geleneksel Türk kahvesi',
                'calories' => 5,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Çay',
                'description' => 'Demlik çay',
                'calories' => 0,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Limonata',
                'description' => 'Taze sıkılmış limonata',
                'calories' => 80,
                'is_vegetarian' => true,
                'is_hot' => false,
                'is_active' => true
            ]
        ];

        foreach ($beverages as $beverage) {
            Beverage::create($beverage);
        }

        // Soups
        $soups = [
            [
                'name' => 'Mercimek Çorbası',
                'description' => 'Geleneksel kırmızı mercimek çorbası',
                'calories' => 180,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Ezogelin Çorbası',
                'description' => 'Geleneksel ezogelin çorbası',
                'calories' => 200,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Tavuk Çorbası',
                'description' => 'Sebzeli tavuk çorbası',
                'calories' => 160,
                'is_vegetarian' => false,
                'is_hot' => true,
                'is_active' => true
            ],
            [
                'name' => 'Yayla Çorbası',
                'description' => 'Yoğurtlu yayla çorbası',
                'calories' => 170,
                'is_vegetarian' => true,
                'is_hot' => true,
                'is_active' => true
            ]
        ];

        foreach ($soups as $soup) {
            Soup::create($soup);
        }
    }
} 