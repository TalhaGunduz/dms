<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'staff_id',
        'document_type',
        'document_number',
        'issue_date',
        'expiry_date',
        'file_path',
        'status',
        'notes',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
