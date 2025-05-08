<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffQualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'staff_id',
        'degree',
        'field_of_study',
        'institution',
        'graduation_year',
        'certification',
        'expiry_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'expiry_date' => 'date',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
