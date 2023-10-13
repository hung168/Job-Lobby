<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add other columns as needed
        'address',
        'street_address',
        'city',
        'state_province',
        'postal_code',
        'country',
    ];

    // Define relationships if needed
    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
