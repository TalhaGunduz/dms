<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->string('degree');
            $table->string('institution');
            $table->string('field_of_study');
            $table->year('graduation_year');
            $table->string('grade')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_qualifications');
    }
};
