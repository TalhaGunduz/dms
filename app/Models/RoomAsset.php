<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'room_id',
        'asset_id',
        'assigned_date',
        'return_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'return_date' => 'date'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
