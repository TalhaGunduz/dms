<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            [
                'tc_no' => '12345678901',
                'name' => 'Ahmet',
                'surname' => 'Yılmaz',
                'birth_date' => '1999-05-01',
                'school' => 'ABC Üniversitesi',
                'department' => 'Bilgisayar Mühendisliği',
                'phone' => '5551234567',
                'email' => 'ahmet.yilmaz@example.com',
                'password' => bcrypt('password123'),  // Şifreyi hash'li şekilde saklıyoruz
                'status' => 'active',
                'room_id' => 1, // örnek olarak bir room_id atadık
            ],
            [
                'tc_no' => '12345678902',
                'name' => 'Mehmet',
                'surname' => 'Kaya',
                'birth_date' => '2000-07-15',
                'school' => 'XYZ Üniversitesi',
                'department' => 'Elektrik Mühendisliği',
                'phone' => '5557654321',
                'email' => 'mehmet.kaya@example.com',
                'password' => bcrypt('password456'),
                'status' => 'active',
                'room_id' => 2, // farklı bir room_id atadık
            ],
            // Daha fazla öğrenci verisi ekleyebilirsiniz.
        ]);
    }
}
