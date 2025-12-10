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

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function cleaningSchedule()
    {
        return $this->belongsTo(CleaningSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rescheduleRequests()
    {
        return $this->hasMany(CleaningAssignmentReschedule::class, 'cleaning_assignment_id');
    }

    // CORREÇÃO: Este método deve retornar uma relação, não um resultado
    public function pendingRescheduleRequest()
    {
        return $this->hasOne(CleaningAssignmentReschedule::class, 'cleaning_assignment_id')
            ->where('status', 'pending');
    }

    // Método para obter o pedido pendente (este sim retorna o modelo)
    public function getPendingReschedule()
    {
        return $this->rescheduleRequests()->where('status', 'pending')->first();
    }

    // Check if assignment is pending response
    public function isPending()
    {
        return $this->response_status === 'pending';
    }

    // Check if assignment is accepted
    public function isAccepted()
    {
        return $this->response_status === 'accepted';
    }

    // Check if assignment is rejected
    public function isRejected()
    {
        return $this->response_status === 'rejected';
    }

    // Check if has pending reschedule request
    public function hasPendingRescheduleRequest()
    {
        return $this->rescheduleRequests()->where('status', 'pending')->exists();
    }
}
