<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'capacity',
        'block_id',
        'current_students',
        'status',
    ];

    // Status constants
    const STATUS_AVAILABLE = 'available';
    const STATUS_OCCUPIED = 'occupied';

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_room')
            ->withTimestamps();
    }

    public function getCurrentStudentsCount(): int
    {
        return $this->students()->count();
    }

    public function getAvailableCapacity(): int
    {
        return $this->capacity - $this->getCurrentStudentsCount();
    }

    public function isFull(): bool
    {
        $currentStudentsCount = DB::table('student_room')
            ->where('room_id', $this->id)
            ->count();
            
        return $currentStudentsCount >= $this->capacity;
    }

    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function isOccupied(): bool
    {
        return $this->status === self::STATUS_OCCUPIED;
    }

    public function updateStatus(): void
    {
        $this->status = $this->getCurrentStudentsCount() > 0 ? self::STATUS_OCCUPIED : self::STATUS_AVAILABLE;
        $this->save();
    }

    protected static function booted()
    {
        static::saved(function ($room) {
            // Update status when room is saved
            if ($room->isDirty('current_students')) {
                $room->updateStatus();
            }
        });
    }
}
