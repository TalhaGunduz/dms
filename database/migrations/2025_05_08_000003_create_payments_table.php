<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_item_id')->constrained()->onDelete('cascade');
            $table->morphs('payer'); // Bu, payer_id ve payer_type kolonlarını oluşturur
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->date('due_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}; 