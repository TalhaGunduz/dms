<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create soups table
        Schema::create('soups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('calories')->default(0);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_hot')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create main dishes table
        Schema::create('main_dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('calories')->default(0);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_hot')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create side dishes table
        Schema::create('side_dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('calories')->default(0);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_hot')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create desserts table
        Schema::create('desserts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('calories')->default(0);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_hot')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create salads table
        Schema::create('salads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('calories')->default(0);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create beverages table
        Schema::create('beverages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('calories')->default(0);
            $table->boolean('is_vegetarian')->default(true);
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beverages');
        Schema::dropIfExists('salads');
        Schema::dropIfExists('desserts');
        Schema::dropIfExists('side_dishes');
        Schema::dropIfExists('main_dishes');
        Schema::dropIfExists('soups');
    }
}; 