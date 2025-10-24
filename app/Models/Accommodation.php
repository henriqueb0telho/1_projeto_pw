<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'max_guests',
        'bedrooms',
        'bathrooms',
        'cleaning_time_estimate',
        'is_active',
        'company_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'cleaning_time_estimate' => 'decimal:2'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Um alojamento pode estar em várias secções
    public function accommodationSections()
    {
        return $this->belongsToMany(AccommodationSection::class, 'acc_section_assignments');
    }

    // Um alojamento tem muitas limpezas agendadas
    public function cleaningSchedules()
    {
        return $this->hasMany(CleaningSchedule::class);
    }

    // Limpezas futuras
    public function upcomingCleanings()
    {
        return $this->cleaningSchedules()->where('scheduled_date', '>=', now());
    }

    // Limpezas concluídas
    public function completedCleanings()
    {
        return $this->cleaningSchedules()->where('status', 'completed');
    }
}
