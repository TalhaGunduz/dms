<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'permissions',
        'status',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'role_id');
    }
}
