<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningAssignment extends Model
{
    use HasFactory;

    protected $table = 'cleaning_assignments';

    protected $fillable = [
        'cleaning_schedule_id',
        'user_id',
        'role_in_cleaning',
        'response_status',
        'responded_at'
    ];

    // Pertence a um agendamento de limpeza
    public function cleaningSchedule()
    {
        return $this->belongsTo(CleaningSchedule::class);
    }

    // Pertence a um utilizador
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
