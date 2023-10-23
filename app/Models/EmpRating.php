<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpRating extends Model
{
    use HasFactory;

    protected $table = 'review_and_rating';

    protected $fillable = [
        'id',
        'user_id', //who being reviewed
        'rateable_id', //who review
        'rateable_type',
        // To store the type of entity (e.g., 'employer' or 'company')
        'rating',
        'comments',
    ];

    public function jobseeker()
    {
        return $this->belongsTo(Jobseeker::class, 'rateable_id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class,'user_id');
    }
}
