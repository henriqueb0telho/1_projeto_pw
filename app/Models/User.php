<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'lat',
        'long',
        'role',
        'company_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'full_name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a manager.
     *
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Check if user is a cleaner.
     *
     * @return bool
     */
    public function isCleaner(): bool
    {
        return $this->role === 'cleaner';
    }

    /**
     * Check if user has admin or manager role.
     *
     * @return bool
     */
    public function isAdminOrManager(): bool
    {
        return in_array($this->role, ['admin', 'manager']);
    }

    /**
     * Check if user is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Relationship: User belongs to a Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relationship: Cleanings assigned to this user (if cleaner)
     */
    public function assignedCleanings()
    {
        return $this->hasMany(CleaningSchedule::class, 'assigned_to');
    }

    public function cleaningAssignments()
    {
        return $this->hasMany(CleaningAssignment::class);
    }

    public function assignedCleaningSchedules()
    {
        return $this->belongsToMany(CleaningSchedule::class, 'cleaning_assignments')
            ->withPivot('role_in_cleaning', 'response_status', 'responded_at')
            ->withTimestamps();
    }

    public function pendingCleaningAssignments()
    {
        return $this->cleaningAssignments()->where('response_status', 'pending');
    }

    public function acceptedCleaningAssignments()
    {
        return $this->cleaningAssignments()->where('response_status', 'accepted');
    }
}
