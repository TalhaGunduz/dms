<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->dateTime('entry_time');
            $table->dateTime('exit_time')->nullable();
            $table->string('entry_type')->default('normal'); // normal, late, emergency
            $table->string('exit_type')->nullable(); // normal, early, emergency
            $table->string('status')->default('inside'); // inside, outside
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_entries');
    }
}; 