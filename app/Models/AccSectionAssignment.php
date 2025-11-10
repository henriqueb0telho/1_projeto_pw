<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSectionAssignment extends Model
{
    use HasFactory;

    protected $table = 'acc_section_assignments';

    protected $fillable = [
        'accommodation_id',
        'accommodation_section_id'
    ];

    // Pertence a um alojamento
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'acc_id');
    }

    // Pertence a uma secção
    public function section()
    {
        return $this->belongsTo(AccommodationSection::class, 'accommodation_section_id');
    }
}
