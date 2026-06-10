<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalInformation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'WeChart_Id' => 'string',
        'position' => 'string',
        'otherPosition' => 'string',
        'introduction' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
