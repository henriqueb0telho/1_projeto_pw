<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningAssignmentReschedule extends Model
{
    use HasFactory;

    protected $table = 'cleaning_assignment_reschedules';

    protected $fillable = [
        'cleaning_assignment_id',
        'requested_date',
        'requested_time',
        'reason',
        'status',
        'manager_response_note'
    ];
}
