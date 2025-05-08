<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'position',
        'department',
        'hire_date',
        'salary',
        'status',
        'role_id',
        'qualification_id',
        'document_id',
        'schedule_id',
        'attendance_id',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'salary' => 'decimal:2',
    ];

    public function role()
    {
        return $this->belongsTo(StaffRole::class, 'role_id');
    }

    public function qualification()
    {
        return $this->belongsTo(StaffQualification::class, 'qualification_id');
    }

    public function document()
    {
        return $this->belongsTo(StaffDocument::class, 'document_id');
    }

    public function schedule()
    {
        return $this->belongsTo(StaffSchedule::class, 'schedule_id');
    }

    public function attendance()
    {
        return $this->belongsTo(StaffAttendance::class, 'attendance_id');
    }
}
