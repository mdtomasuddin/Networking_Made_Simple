<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    //table prefix
    protected $table = 'users';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['password', 'remember_token'];

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    //Get the identifier that will be stored in the subject claim of the JWT.
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    //Return a key value array, containing any custom claims to be added to the JWT.
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageAttribute($url): string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('storage/' . $url);
            }
        } else {
            return asset('assets/backend/images/placeholder/placeholder-4by3.svg');
        }
    }


    //Accessor for avatar attribute
    public function getAvatarAttribute($url): ?string
    {
        return $url ?: null;
    }

    // Relationships and other model methods can be added here
    public function otps(): HasMany
    {
        return $this->hasMany(OTP::class);
    }
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
