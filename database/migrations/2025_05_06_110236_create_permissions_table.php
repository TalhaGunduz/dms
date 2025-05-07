<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Insert default permissions
        DB::table('permissions')->insert([
            ['name' => 'manage_users', 'description' => 'Kullanıcı yönetimi'],
            ['name' => 'manage_students', 'description' => 'Öğrenci yönetimi'],
            ['name' => 'manage_rooms', 'description' => 'Oda yönetimi'],
            ['name' => 'manage_assets', 'description' => 'Demirbaş yönetimi'],
            ['name' => 'manage_room_assets', 'description' => 'Oda demirbaş yönetimi'],
            ['name' => 'manage_maintenance', 'description' => 'Bakım yönetimi'],
            ['name' => 'change_room', 'description' => 'Oda değiştirme'],
            ['name' => 'view_reports', 'description' => 'Raporları görüntüleme'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
