<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'address',
        'lat',
        'long',
        'role',
        'company_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accessor para nome completo
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Scope para utilizadores ativos
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope por role
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Um utilizador pertence a uma empresa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Um utilizador pode estar em várias secções
    public function accommodationSections()
    {
        return $this->belongsToMany(AccommodationSection::class, 'user_section_assignments');
    }

    // Um utilizador pode ter várias limpezas atribuídas
    public function cleaningSchedules()
    {
        return $this->belongsToMany(CleaningSchedule::class, 'cleaning_assignments');
    }

    // Limpezas onde o utilizador é o responsável principal
    public function primaryCleanings()
    {
        return $this->cleaningSchedules()->wherePivot('role_in_cleaning', 'primary');
    }

    // Verificar se o utilizador é admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Verificar se o utilizador é gestor
    public function isManager()
    {
        return $this->role === 'manager';
    }

    // Verificar se o utilizador é funcionário de limpeza
    public function isCleaner()
    {
        return $this->role === 'cleaner';
    }

    // Verificar se o utilizador está ativo
    public function isActive()
    {
        return $this->status === 'active';
    }
}
