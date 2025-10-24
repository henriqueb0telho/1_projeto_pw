<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id'
    ];

    // Uma secção pertence a uma empresa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Uma secção tem muitos alojamentos
    public function accommodations()
    {
        return $this->belongsToMany(Accommodation::class, 'acc_section_assignments');
    }

    // Uma secção tem muitos utilizadores
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_section_assignments');
    }

    // Número de alojamentos ativos nesta secção
    public function activeAccommodationsCount()
    {
        return $this->accommodations()->where('is_active', true)->count();
    }
}
