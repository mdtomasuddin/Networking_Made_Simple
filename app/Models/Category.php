<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * casts the attributes to their respective types.
     */
    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'image'      => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Accessor for image
    public function getImageAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    public function jobResponsibities()
    {
        return $this->hasMany(JobResponsibity::class);
    }
}
