<?php
// app/Models/Block.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    // Yalnızca bu alanlar için doldurma izni veriyoruz
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getTotalRoomsAttribute()
    {
        return $this->rooms()->count();
    }

    public function getAvailableRoomsAttribute()
    {
        return $this->rooms()
            ->whereRaw('capacity > current_students')
            ->count();
    }
}
