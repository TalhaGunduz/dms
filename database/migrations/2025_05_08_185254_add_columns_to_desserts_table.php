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
        Schema::table('desserts', function (Blueprint $table) {
            // $table->string('status')->default('active'); // Zaten var, hata veriyor
            // $table->softDeletes(); // Zaten var, hata veriyor
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desserts', function (Blueprint $table) {
            // $table->dropColumn('status');
            // $table->dropSoftDeletes(); // Zaten var, hata veriyor
        });
    }
}; 