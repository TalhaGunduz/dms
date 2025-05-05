<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('rooms', function (Blueprint $table) {
        // Eğer block_id sütunu yoksa, onu ekle
        if (!Schema::hasColumn('rooms', 'block_id')) {
            $table->unsignedBigInteger('block_id')->nullable();
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('set null');
        }
    });
}

public function down()
{
    Schema::table('rooms', function (Blueprint $table) {
        // block_id sütununu geri al
        if (Schema::hasColumn('rooms', 'block_id')) {
            $table->dropForeign(['block_id']);
            $table->dropColumn('block_id');
        }
    });
}

};
