<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
    use HasFactory;

    protected $table = 'job_seekers';

    protected $fillable = [
        'id',
        'user_id',
        'jobseeker_profile_pic',
        'address',
        'name',
        'email',
        'gender',
        'date_of_birth',
        'country',
        'nationality',
        'telephone',
        'education_level',
        'field_of_major',
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
