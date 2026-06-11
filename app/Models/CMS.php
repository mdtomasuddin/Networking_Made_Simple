<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
        // Table prefix
        protected $table = 'cms';

        // The attributes that are mass assignable.
        protected $guarded = [];

        // The attributes that should be hidden for serialization.
        protected $hidden = [];

        // The attributes that should be cast.
        protected $casts = [
                'id'              => 'integer',
                'sub_image'       => 'array',
                'image'           => 'string',
                'title'           => 'string',
                'page'            => 'string',
                'section'         => 'string',
                'description'     => 'string',
                'sub_title'       => 'string',
                'sub_description' => 'string',
                'button'          => 'string',
                'sub_button'      => 'string',
                'status'          => 'string',
                'created_at'      => 'datetime',
                'updated_at'      => 'datetime',
        ];

        // Relationships and other model methods can be added here
}
