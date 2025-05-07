<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'maintenance_request_id',
        'performed_by',
        'description',
        'cost',
        'status',
        'maintenance_date',
        'notes'
    ];

    protected $casts = [
        'maintenance_date' => 'date',
        'cost' => 'decimal:2'
    ];

    public function maintenanceRequest()
    {
        return $this->belongsTo(MaintenanceRequest::class);
    }

    public function maintainer()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
