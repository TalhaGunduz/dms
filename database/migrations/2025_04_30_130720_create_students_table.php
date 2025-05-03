<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('tc_no')->unique();
            $table->string('name');
            $table->string('surname');
            $table->date('birth_date');
            $table->string('school');
            $table->string('department');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('status')->default('active');
            $table->string('password');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
