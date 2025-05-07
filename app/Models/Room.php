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
    ];

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
}
