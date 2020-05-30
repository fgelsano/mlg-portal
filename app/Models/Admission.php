<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table = 'admissions';
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'civil_status',
        'religion',
        'house_number',
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
        'sf9-front',
        'sf9-back',
        'gwa',
        'gmc',
        'psa_bc',
        'med_cert',
        'hd'
    ];
}
