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
        Schema::table('staff_qualifications', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('graduation_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_qualifications', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};
