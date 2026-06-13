<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recognition extends Model
{
    //table prefix
    protected $table = 'recognitions';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'title'       => 'string',
        'description' => 'string',
        'year'        => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
