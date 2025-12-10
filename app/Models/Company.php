<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'nif'
    ];

    // Uma empresa tem muitos utilizadores
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }


    // Uma empresa tem muitas secções
    public function accommodationSections()
    {
        return $this->hasMany(AccommodationSection::class);
    }
}
