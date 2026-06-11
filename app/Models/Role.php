<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    // Table prefix
    protected $table = 'roles';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Relationships and other model methods can be added here
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
