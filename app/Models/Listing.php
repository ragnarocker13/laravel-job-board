<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // fillable property needs to be declared protected here to allow mass assignments
    // or just declare Model::unguard(); to the AppServiceProvider.php
    // protected $fillable = ['title', 'company', 'location', 'email', 'website', 'tags', 'description'];
    
    // scope methods need to be declared in the model with 'scopeMethodname' 
    // then accessed in the controller using Model::methodname()->get()
    
    // $query is the default parameter for Laravel's eloquent, 
    // followed by an array that contains the tags needed to be displayed
    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            // this method will allow our controller to filter our parameters instead of getting all the records
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('tags', 'like', '%' . request('search') . '%')
            ->orWhere('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%', request('search') . '%')
            ->orWhere('location', 'like', '%', request('search') . '%');
        }
    }
}