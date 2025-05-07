<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'room_id',
        'asset_id',
        'requested_by',
        'priority',
        'description',
        'status',
        'requested_date',
        'scheduled_date',
        'completion_date'
    ];

    protected $casts = [
        'requested_date' => 'date',
        'scheduled_date' => 'date',
        'completion_date' => 'date'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}
