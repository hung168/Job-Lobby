<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
    use HasFactory;

    protected $table = 'jobseekers';

    protected $fillable = [
        'id',
        'user_id',
        'jobseeker_profile_pic',
        'name',
        'address',
        'date_of_birth',
        'gender',
        'nationality',
        'email',
        'telephone',
        'field_of_major',
        'education_level',
    ];

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobExperiences()
    {
        return $this->hasMany(JobseekerJobExperience::class);
    }

    public function ratings(){
        return $this->hasOne(EmpRating::class, 'user_id');
    }
}
