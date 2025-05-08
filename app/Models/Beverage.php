<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beverage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'calories',
        'is_hot',
        'is_active'
    ];

    protected $casts = [
        'calories' => 'decimal:2',
        'is_hot' => 'boolean',
        'is_active' => 'boolean'
    ];
} 