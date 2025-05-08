<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('main_dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('calories')->nullable();
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('side_dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('calories')->nullable();
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('desserts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('calories')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('salads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('calories')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('beverages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('calories')->nullable();
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('soups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('calories')->nullable();
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('daily_menus', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('main_dish_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('side_dish_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('dessert_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('salad_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('beverage_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('soup_id')->nullable()->constrained()->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_menus');
        Schema::dropIfExists('soups');
        Schema::dropIfExists('beverages');
        Schema::dropIfExists('salads');
        Schema::dropIfExists('desserts');
        Schema::dropIfExists('side_dishes');
        Schema::dropIfExists('main_dishes');
    }
}; 