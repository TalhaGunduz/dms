<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'staff_id',
        'day_of_week',
        'start_time',
        'end_time',
        'break_start',
        'break_end',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'break_start' => 'datetime',
        'break_end' => 'datetime',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
