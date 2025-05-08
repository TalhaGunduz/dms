<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'from_room_id',
        'to_room_id',
        'transfer_date',
        'reason',
        'status'
    ];

    protected $casts = [
        'transfer_date' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromRoom()
    {
        return $this->belongsTo(Room::class, 'from_room_id');
    }

    public function toRoom()
    {
        return $this->belongsTo(Room::class, 'to_room_id');
    }
} 