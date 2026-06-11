<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    // Use soft deletes for the model
    use SoftDeletes;

    //table prefix
    protected $table = 'social_media';

    // The attributes that are mass assignable.
    protected $guarded = [];

    //The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    //The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'           => 'integer',
            'social_media' => 'string',
            'profile_link' => 'string',
            'created_at'   => 'datetime',
            'updated_at'   => 'datetime',
            'deleted_at'   => 'datetime',
        ];
    }
    // Relationships and other model methods can be added here
}
