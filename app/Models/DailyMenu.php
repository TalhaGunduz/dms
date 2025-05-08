<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'menu_date',
        'main_dish_id',
        'side_dish_id',
        'dessert_id',
        'salad_id',
        'beverage_id',
        'soup_id',
        'meal_type',
        'is_active',
        'notes',
        'created_by'
    ];

    protected $casts = [
        'menu_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function mainDish()
    {
        return $this->belongsTo(MainDish::class);
    }

    public function sideDish()
    {
        return $this->belongsTo(SideDish::class);
    }

    public function dessert()
    {
        return $this->belongsTo(Dessert::class);
    }

    public function salad()
    {
        return $this->belongsTo(Salad::class);
    }

    public function beverage()
    {
        return $this->belongsTo(Beverage::class);
    }

    public function soup()
    {
        return $this->belongsTo(Soup::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
} 