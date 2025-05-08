<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->onDelete('cascade');
            $table->string('receipt_number')->unique();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->date('receipt_date');
            $table->string('receipt_image')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verification_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_receipts');
    }
}; 