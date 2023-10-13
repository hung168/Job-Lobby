<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerJobExperience extends Model
{
    use HasFactory;

    protected $table = 'job_seeker_job_experiences';


    protected $fillable = [
        'id',
        'job_seeker_id',
        'job_seeker_name',
        'company_name',
        'job_title',
        'job_description',
        'start_date',
        'end_date',
    ];

    public static $rules = [
        'job_title' => 'required',
        'company_name' => 'required',
        'job_description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'job_seeker_name' => 'required',
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(Jobseeker::class, 'job_seeker_id', 'user_id');
    }
}
