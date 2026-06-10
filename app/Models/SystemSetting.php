<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $table = 'system_settings';

    protected $guarded = [];

    protected $casts   = [
        'id'                => 'integer',
        'title'             => 'string',
        'system_name'       => 'string',
        'email'             => 'string',
        'contact_number'    => 'string',
        'company_open_hour' => 'string',
        'copyright_text'    => 'string',
        'logo'              => 'string',
        'favicon'           => 'string',
        'sidebar'           => 'string',
        'address'           => 'string',
        'description'       => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    public function getFileUrlAttribute($value): ?string
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        if (request()->is('api/*') && ! empty($value)) {
            return url($value);
        }

        return $value;
    }

    // Use this function in your existing attributes
    public function getLogoAttribute($value): ?string
    {
        return $this->getFileUrlAttribute($value);
    }

    public function getFaviconAttribute($value): ?string
    {
        return $this->getFileUrlAttribute($value);
    }

    public function getSidebarAttribute($value): ?string
    {
        return $this->getFileUrlAttribute($value);
    }
}
