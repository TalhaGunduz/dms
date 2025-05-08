<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;
use App\Models\PaymentItem;
use App\Models\Payment;
use App\Models\PaymentReceipt;
use App\Models\Student;
use App\Models\Staff;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ödeme Türleri
        $paymentTypes = [
            [
                'name' => 'Nakit',
                'description' => 'Nakit ödeme'
            ],
            [
                'name' => 'Banka Transferi',
                'description' => 'Banka havalesi veya EFT'
            ],
            [
                'name' => 'Kredi Kartı',
                'description' => 'Kredi kartı ile ödeme'
            ],
            [
                'name' => 'Çek',
                'description' => 'Çek ile ödeme'
            ]
        ];

        foreach ($paymentTypes as $type) {
            PaymentType::create($type);
        }

        // Ödeme Kalemleri
        $paymentItems = [
            [
                'name' => 'Yurt Ücreti',
                'description' => 'Aylık yurt ücreti'
            ],
            [
                'name' => 'Yemek Ücreti',
                'description' => 'Aylık yemek ücreti'
            ],
            [
                'name' => 'Personel Maaşı',
                'description' => 'Aylık personel maaşı'
            ],
            [
                'name' => 'Ek Hizmet Ücreti',
                'description' => 'Ek hizmetler için ücret'
            ],
            [
                'name' => 'Depozito',
                'description' => 'Yurt depozito ücreti'
            ]
        ];

        foreach ($paymentItems as $item) {
            PaymentItem::create($item);
        }

        // Örnek Ödemeler ve Dekontlar
        // Öğrenci ödemeleri
        $students = Student::take(5)->get();
        foreach ($students as $student) {
            $payment = Payment::create([
                'payment_type_id' => PaymentType::inRandomOrder()->first()->id,
                'payment_item_id' => PaymentItem::where('name', 'Yurt Ücreti')->first()->id,
                'payer_id' => $student->id,
                'payer_type' => Student::class,
                'amount' => rand(1000, 2000),
                'payment_date' => now(),
                'due_date' => now()->addMonth(),
                'status' => 'approved',
                'notes' => 'Aylık yurt ücreti ödemesi'
            ]);

            // Dekont ekle
            PaymentReceipt::create([
                'payment_id' => $payment->id,
                'receipt_number' => 'RCP-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT),
                'bank_name' => 'Örnek Bank',
                'account_number' => 'TR' . rand(100000000000000000, 999999999999999999),
                'receipt_date' => now(),
                'receipt_image' => 'receipts/sample.jpg',
                'verified_by' => 1, // Admin user ID
                'verification_date' => now()
            ]);
        }

        // Personel ödemeleri
        $staff = Staff::take(3)->get();
        foreach ($staff as $employee) {
            $payment = Payment::create([
                'payment_type_id' => PaymentType::inRandomOrder()->first()->id,
                'payment_item_id' => PaymentItem::where('name', 'Personel Maaşı')->first()->id,
                'payer_id' => $employee->id,
                'payer_type' => Staff::class,
                'amount' => rand(5000, 10000),
                'payment_date' => now(),
                'due_date' => now()->addMonth(),
                'status' => 'approved',
                'notes' => 'Aylık personel maaşı ödemesi'
            ]);

            // Dekont ekle
            PaymentReceipt::create([
                'payment_id' => $payment->id,
                'receipt_number' => 'RCP-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT),
                'bank_name' => 'Örnek Bank',
                'account_number' => 'TR' . rand(100000000000000000, 999999999999999999),
                'receipt_date' => now(),
                'receipt_image' => 'receipts/sample.jpg',
                'verified_by' => 1, // Admin user ID
                'verification_date' => now()
            ]);
        }
    }
}
