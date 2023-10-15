<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listings;

class UserListing extends Model
{
    use HasFactory;

    protected $table = 'users_listings';

    protected $fillable = [
        'user_id',
        'listing_id',
        'status',
    ];
    
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
