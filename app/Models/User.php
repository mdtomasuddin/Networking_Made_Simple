<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
            'id'                   => 'integer',
            'email_verified_at'    => 'datetime',
            'password'             => 'hashed',
            'phone'                => 'string',
            'first_name'           => 'string',
            'last_name'            => 'string',
            'handle'               => 'string',
            'avatar'               => 'string',
            'cover_photo'          => 'string',
            'job_title'            => 'string',
            'company_name'         => 'string',
            'location'             => 'string',
            'bio'                  => 'string',
            'role_id'              => 'integer',
            'nfc_card_id'          => 'string',
            'terms_and_conditions' => 'boolean',
            'status'               => 'string',
            'remember_token'       => 'string',
            'created_at'           => 'datetime',
            'updated_at'           => 'datetime',
            'deleted_at'           => 'datetime',
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

    // Accessor for the avatar attribute
    public function getAvatarAttribute($url): ?string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('/' . $url);
            }
        }
        return null;
    }
    // Accessor for the cover photo attribute
    public function getCoverPhotoAttribute($url): ?string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('/' . $url);
            }
        }
        return null;
    }

    // Relationships and other model methods can be added here
    public function otps()
    {
        return $this->hasMany(OTP::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
    public function businessCard()
    {
        return $this->hasOne(BusinessCard::class);
    }
    public function paymentLink()
    {
        return $this->hasOne(PaymentLink::class);
    }
    public function theme()
    {
        return $this->hasOne(Theme::class);
    }
}
