<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'capacity',
        'block_id',
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
        return $this->getAvailableCapacity() <= 0;
    }
}
