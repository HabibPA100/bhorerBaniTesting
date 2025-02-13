<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'email',
        'password',
        'bangla_name',
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'mobile_number',
        'whatsapp_number',
        'dob',
        'education_qualifications',
        'national_id',
        'interested_position',
        'responsible_place_name',
        'accept_terms_conditions',
        'role_id',
    ];

    /**
     * Get the address associated with the representative.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'role_id');
    }

    /**
     * Get the address associated with the representative.
     */
    public function address()
    {
        return $this->hasOne(RepresentativeAddress::class, 'representative_id');
    }
}
