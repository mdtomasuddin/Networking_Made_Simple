<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model
{
    //table prefix
    protected $table = 'business_cards';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'front_image' => 'string',
        'back_image'  => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // Accessor for the front image attribute
    public function getFrontImageAttribute($url): ?string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('/' . $url);
            }
        }
        return null;
    }

    // Accessor for the back image attribute
    public function getBackImageAttribute($url): ?string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('/' . $url);
            }
        }
        return null;
    }

    // Relationships and other model methods can be added here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
