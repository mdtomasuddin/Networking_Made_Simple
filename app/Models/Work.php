<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'image'       => 'string',
            'skills'      => 'string',
            'description' => 'string',
            'title'       => 'string',
            'status'      => 'string',
        ];
    }
    // Accessor for image
    public function getImageAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }
}
