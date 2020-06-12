<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'img',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'civil_status',
        'religion',
        'purok',
        'sitio',
        'street_barangay',
        'municipality',
        'province',
        'zip_code',
        'parent_guardian_name',
        'parent_guardian_contact',
        'school_graduated',
        'year_graduated',
        'school_address',
        'lrn',
        'course',
        'year_level',
        'status',
        'type',
        'completed'
    ];

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }
}
