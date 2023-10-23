<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['id','title', 'company', 'academic_field', 'employer_user_id','location','logo', 'website', 'email', 'description', 'tags', 'reported', 'verified','slots_available','boosted'];

    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false) {
            $query->where('tags','like','%'. request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title','like','%'. request('search') . '%')
            ->orWhere('description','like','%'. request('search') . '%')
            ->orWhere('tags','like','%'. request('search') . '%');
            
        }
    }

    //Link listing to employer user id

    public function employer(){
        return $this->belongsTo(Employer::class,'employer_user_id');
    }



}
