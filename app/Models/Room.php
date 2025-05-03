<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'capacity',
        'current_students',
        'block_id',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // app/Models/Room.php
public function block()
{
    return $this->belongsTo(Block::class);
}

}
