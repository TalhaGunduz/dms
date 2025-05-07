<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;
use Carbon\Carbon;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assets = [
            [
                'name' => 'Dell Latitude 5430',
                'type' => 'electronics',
                'serial_number' => 'DL5430-2024-001',
                'purchase_price' => 24500,
                'purchase_date' => '2023-09-15',
                'status' => 'available',
                'description' => 'Kurumsal dizüstü bilgisayar, 16GB RAM, 512GB SSD'
            ],
            [
                'name' => 'HP LaserJet Pro M404dn',
                'type' => 'electronics',
                'serial_number' => 'HP-M404-2023-002',
                'purchase_price' => 8500,
                'purchase_date' => '2023-08-10',
                'status' => 'in_use',
                'description' => 'A4 lazer yazıcı, network bağlantılı'
            ],
            [
                'name' => 'Ofis Masası - Ahşap',
                'type' => 'furniture',
                'serial_number' => 'MASA-2023-003',
                'purchase_price' => 3200,
                'purchase_date' => '2023-07-01',
                'status' => 'in_use',
                'description' => '180x80 cm, ceviz kaplama'
            ],
            [
                'name' => 'Ergonomik Ofis Sandalyesi',
                'type' => 'furniture',
                'serial_number' => 'SANDALYE-2023-004',
                'purchase_price' => 1800,
                'purchase_date' => '2023-07-01',
                'status' => 'in_use',
                'description' => 'Siyah, bel destekli, tekerlekli'
            ],
            [
                'name' => 'Samsung 55" LED TV',
                'type' => 'electronics',
                'serial_number' => 'SMTV-2022-005',
                'purchase_price' => 12000,
                'purchase_date' => '2022-12-20',
                'status' => 'available',
                'description' => 'Toplantı odası için, duvara montajlı'
            ],
            [
                'name' => 'Vestel Klima 18.000 BTU',
                'type' => 'electronics',
                'serial_number' => 'VESTEL-KLIMA-2022-006',
                'purchase_price' => 14500,
                'purchase_date' => '2022-06-15',
                'status' => 'maintenance',
                'description' => 'Bakımda, gaz dolumu yapılacak'
            ],
            [
                'name' => 'Acer Projeksiyon Cihazı',
                'type' => 'electronics',
                'serial_number' => 'ACER-PROJ-2021-007',
                'purchase_price' => 9500,
                'purchase_date' => '2021-11-05',
                'status' => 'in_use',
                'description' => 'Toplantı salonunda kullanılıyor'
            ],
            [
                'name' => 'Çelik Kasa',
                'type' => 'furniture',
                'serial_number' => 'KASA-2020-008',
                'purchase_price' => 6000,
                'purchase_date' => '2020-03-10',
                'status' => 'available',
                'description' => 'Belge ve değerli eşya saklama'
            ],
            [
                'name' => 'Masaüstü Bilgisayar - Lenovo',
                'type' => 'electronics',
                'serial_number' => 'LENOVO-DESK-2023-009',
                'purchase_price' => 17500,
                'purchase_date' => '2023-02-18',
                'status' => 'in_use',
                'description' => '8GB RAM, 256GB SSD, Windows 11 Pro'
            ],
            [
                'name' => 'Beyaz Tahta',
                'type' => 'furniture',
                'serial_number' => 'TAHTA-2022-010',
                'purchase_price' => 900,
                'purchase_date' => '2022-09-01',
                'status' => 'available',
                'description' => '120x90 cm, duvara montajlı'
            ],
        ];

        foreach ($assets as $asset) {
            Asset::create($asset);
        }
    }
}
