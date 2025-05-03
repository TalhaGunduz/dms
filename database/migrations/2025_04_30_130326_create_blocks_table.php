<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id(); // 'id' sütunu, otomatik olarak BIGINT ve auto_increment olur
            $table->string('name'); // blok adı
            $table->timestamps(); // created_at ve updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
