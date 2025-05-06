<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'tc_no',
        'name',
        'surname',
        'birth_date',
        'school',
        'department',
        'phone',
        'email',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'student_room')
            ->withTimestamps();
    }

    public function getCurrentRoom()
    {
        return $this->rooms()->first();
    }
}
