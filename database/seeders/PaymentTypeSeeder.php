<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $paymentTypes = [
            [
                'name' => 'Room Fee',
                'description' => 'Monthly room fee payment',
                'is_recurring' => true,
                'recurring_period' => 'monthly'
            ],
            [
                'name' => 'Deposit',
                'description' => 'One-time security deposit',
                'is_recurring' => false,
                'recurring_period' => null
            ],
            [
                'name' => 'Meal Plan',
                'description' => 'Monthly meal plan payment',
                'is_recurring' => true,
                'recurring_period' => 'monthly'
            ],
            [
                'name' => 'Damage Fee',
                'description' => 'One-time payment for damages',
                'is_recurring' => false,
                'recurring_period' => null
            ],
            [
                'name' => 'Late Payment Fee',
                'description' => 'Fee for late payments',
                'is_recurring' => false,
                'recurring_period' => null
            ]
        ];

        foreach ($paymentTypes as $type) {
            DB::table('payment_types')->insert([
                'name' => $type['name'],
                'description' => $type['description'],
                'is_recurring' => $type['is_recurring'],
                'recurring_period' => $type['recurring_period'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 