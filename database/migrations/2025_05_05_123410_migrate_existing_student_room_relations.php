<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Room;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mevcut öğrenci-oda ilişkilerini al
        $students = Student::whereNotNull('room_id')->get();

        // Her öğrenci için yeni pivot tabloya kayıt ekle
        foreach ($students as $student) {
            if ($student->room_id) {
                DB::table('student_room')->insert([
                    'student_id' => $student->id,
                    'room_id' => $student->room_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Eski room_id sütununu kaldır
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['room_id']); // Eğer foreign key varsa
            $table->dropColumn('room_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Geri alma işlemi için room_id sütununu tekrar ekle
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('room_id')->nullable()->constrained();
        });

        // Pivot tablodaki ilişkileri geri taşı
        $relations = DB::table('student_room')->get();
        foreach ($relations as $relation) {
            DB::table('students')
                ->where('id', $relation->student_id)
                ->update(['room_id' => $relation->room_id]);
        }
    }
};
