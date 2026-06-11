<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    //enable soft deletes
    use SoftDeletes;

    //table prefix
    protected $table = "contents";

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'deleted_at'];

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'         => 'int',
            'type'       => 'string',
            'title'      => 'string',
            'slug'       => 'string',
            'content'    => 'string',
            'status'     => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    //Relationships and other model methods can be added here


}
