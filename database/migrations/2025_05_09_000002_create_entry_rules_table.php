<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entry_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('entry_time_start');
            $table->time('entry_time_end');
            $table->time('exit_time_start');
            $table->time('exit_time_end');
            $table->json('allowed_days')->nullable(); // Hangi günler geçerli (örn: [1,2,3,4,5] hafta içi)
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entry_rules');
    }
}; 