<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'tc_no' => '12345678901',
                'name' => 'Ahmet',
                'surname' => 'Yılmaz',
                'birth_date' => '2000-01-01',
                'school' => 'Ankara Üniversitesi',
                'department' => 'Bilgisayar Mühendisliği',
                'phone' => '5551234567',
                'email' => 'ahmet.yilmaz@example.com',
                'status' => 1,
                'password' => Hash::make('password123')
            ],
            [
                'tc_no' => '23456789012',
                'name' => 'Ayşe',
                'surname' => 'Demir',
                'birth_date' => '2001-02-02',
                'school' => 'İstanbul Üniversitesi',
                'department' => 'Elektrik Mühendisliği',
                'phone' => '5552345678',
                'email' => 'ayse.demir@example.com',
                'status' => 1,
                'password' => Hash::make('password123')
            ],
            [
                'tc_no' => '34567890123',
                'name' => 'Mehmet',
                'surname' => 'Kaya',
                'birth_date' => '2002-03-03',
                'school' => 'İzmir Yüksek Teknoloji Enstitüsü',
                'department' => 'Makine Mühendisliği',
                'phone' => '5553456789',
                'email' => 'mehmet.kaya@example.com',
                'status' => 1,
                'password' => Hash::make('password123')
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
} 