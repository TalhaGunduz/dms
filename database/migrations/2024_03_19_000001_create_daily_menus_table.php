<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_menus', function (Blueprint $table) {
            $table->id();
            $table->dateTime('menu_date');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner']);
            $table->foreignId('soup_id')->nullable()->constrained('soups')->nullOnDelete();
            $table->foreignId('main_dish_id')->nullable()->constrained('main_dishes')->nullOnDelete();
            $table->foreignId('side_dish_id')->nullable()->constrained('side_dishes')->nullOnDelete();
            $table->foreignId('dessert_id')->nullable()->constrained('desserts')->nullOnDelete();
            $table->foreignId('salad_id')->nullable()->constrained('salads')->nullOnDelete();
            $table->foreignId('beverage_id')->nullable()->constrained('beverages')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_menus');
    }
}; 