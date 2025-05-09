<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_type_id',
        'payment_item_id',
        'payer_id',
        'payer_type',
        'amount',
        'payment_date',
        'due_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'due_date' => 'date',
    ];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function paymentItem()
    {
        return $this->belongsTo(PaymentItem::class);
    }

    public function payer()
    {
        return $this->morphTo();
    }

    public function receipt()
    {
        return $this->hasOne(PaymentReceipt::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'payer_id');
    }

    public function getPayerNameAttribute()
    {
        if ($this->payer_type === Student::class) {
            return $this->payer->first_name . ' ' . $this->payer->last_name;
        } elseif ($this->payer_type === Staff::class) {
            return $this->payer->first_name . ' ' . $this->payer->last_name;
        }
        return 'Bilinmeyen';
    }

    public function getPayerTypeNameAttribute()
    {
        return $this->payer_type === Student::class ? 'Öğrenci' : 'Personel';
    }
} 