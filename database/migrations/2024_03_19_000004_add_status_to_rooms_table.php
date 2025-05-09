<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddStatusToRoomsTable extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('status')->default('available')->after('current_students');
        });

        // Update existing rooms based on current_students
        DB::table('rooms')->where('current_students', '>', 0)->update(['status' => 'occupied']);
        DB::table('rooms')->where('current_students', 0)->update(['status' => 'available']);
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
} 