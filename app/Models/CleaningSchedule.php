<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'scheduled_date',
        'scheduled_time',
        'status',
        'notes',
        'actual_duration'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'scheduled_time' => 'datetime:H:i',
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    // Relação através da tabela cleaning_assignments
    public function users()
    {
        return $this->belongsToMany(User::class, 'cleaning_assignments')
            ->withPivot('role_in_cleaning', 'response_status', 'responded_at')
            ->withTimestamps();
    }

    // Relação direta com cleaning_assignments
    public function cleaningAssignments()
    {
        return $this->hasMany(CleaningAssignment::class);
    }

    // Funcionários principais nesta limpeza
    public function primaryCleaners()
    {
        return $this->users()->wherePivot('role_in_cleaning', 'primary');
    }

    // Ajudantes nesta limpeza
    public function assistants()
    {
        return $this->users()->wherePivot('role_in_cleaning', 'assistant');
    }

    // Limpezas atribuídas ao usuário atual
    public function scopeAssignedToUser($query, $userId)
    {
        return $query->whereHas('cleaningAssignments', function($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }
}
