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
    ];

    // Uma limpeza pertence a um alojamento
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    // Uma limpeza pode ter vários funcionários atribuídos
    public function users()
    {
        return $this->belongsToMany(User::class, 'cleaning_assignments')
            ->withPivot('role_in_cleaning');
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
}
