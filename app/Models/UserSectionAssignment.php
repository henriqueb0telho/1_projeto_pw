<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSectionAssignment extends Model
{
    use HasFactory;

    protected $table = 'user_section_assignments';

    protected $fillable = [
        'user_id',
        'sec_id'
    ];

    // Pertence a um utilizador
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pertence a uma secção
    public function section()
    {
        return $this->belongsTo(AccommodationSection::class, 'sec_id');
    }
}
