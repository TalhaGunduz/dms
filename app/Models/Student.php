<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'room_id', // eğer oda ataması yapılacaksa
    ];

    protected $hidden = [
        'password',
    ];

    // Eğer oda ilişkisi varsa:
    public function room()
    {
        return $this->belongsTo(Room::class);
    }


}
