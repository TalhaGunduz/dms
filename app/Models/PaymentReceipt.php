<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'receipt_number',
        'bank_name',
        'account_number',
        'receipt_date',
        'receipt_image',
        'verified_by',
        'verification_date',
    ];

    protected $casts = [
        'receipt_date' => 'date',
        'verification_date' => 'datetime',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
} 