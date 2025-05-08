<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentItemSeeder extends Seeder
{
    public function run(): void
    {
        $paymentItems = [
            [
                'name' => 'Monthly Room Fee',
                'description' => 'Standard monthly room fee',
                'amount' => 2500.00,
                'payment_type_id' => DB::table('payment_types')->where('name', 'Room Fee')->first()->id,
            ],
            [
                'name' => 'Security Deposit',
                'description' => 'Refundable security deposit',
                'amount' => 1000.00,
                'payment_type_id' => DB::table('payment_types')->where('name', 'Deposit')->first()->id,
            ],
            [
                'name' => 'Monthly Meal Plan - Standard',
                'description' => 'Standard meal plan with 3 meals per day',
                'amount' => 1500.00,
                'payment_type_id' => DB::table('payment_types')->where('name', 'Meal Plan')->first()->id,
            ],
            [
                'name' => 'Late Payment Fee - Standard',
                'description' => 'Standard late payment fee',
                'amount' => 250.00,
                'payment_type_id' => DB::table('payment_types')->where('name', 'Late Payment Fee')->first()->id,
            ],
            [
                'name' => 'Damage Fee - Minor',
                'description' => 'Fee for minor damages',
                'amount' => 500.00,
                'payment_type_id' => DB::table('payment_types')->where('name', 'Damage Fee')->first()->id,
            ],
            [
                'name' => 'Damage Fee - Major',
                'description' => 'Fee for major damages',
                'amount' => 1500.00,
                'payment_type_id' => DB::table('payment_types')->where('name', 'Damage Fee')->first()->id,
            ],
        ];

        foreach ($paymentItems as $item) {
            DB::table('payment_items')->insert([
                'name' => $item['name'],
                'description' => $item['description'],
                'amount' => $item['amount'],
                'payment_type_id' => $item['payment_type_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 