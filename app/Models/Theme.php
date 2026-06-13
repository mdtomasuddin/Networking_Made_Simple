<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    // table prefix
    protected $table = 'themes';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'            => 'integer',
        'name'          => 'string',
        'description'   => 'string',
        'primary_color' => 'string',
        'accent_color'  => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
