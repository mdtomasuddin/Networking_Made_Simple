<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Table prefix
    protected $table = 'categories';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'image'      => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Accessor for the image attribute
    public function getImageAttribute($url): ?string
    {
        // Check if the URL is not empty
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url; // Return the URL as is if it already contains http:// or https://
            } else {
                return asset('/' . $url); // Return the full URL
            }
        }
        return null; // Return null if the URL is empty
    }
}
