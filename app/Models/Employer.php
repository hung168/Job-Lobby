<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'function_title',
        'department',

        'company_name',
        'company_industry',
        'company_overview',
        'company_registration_number',
        'address',
        'company_contact_number',
        'company_website',
        'company_size',
        'company_working_hour',
        'company_dress_code',
        'company_benefits',
    ];

    public function employer_listings(){
        return $this->hasMany(Listing::class, 'employer_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id');
    }
}
