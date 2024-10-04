<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'encrypted_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'encrypted_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'encrypted_password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['encrypted_password'] = bcrypt($value);
    }

    /*
     The next three methods are alternatives acting similarly.
     The idea is to override the default behavior of the Authenticatable class
     where the "password" key is expected
    */
    public function getAuthPassword()
    {
        return $this->attributes['encrypted_password'];
    }
    /*
    public function getPasswordAttribute()
    {
        return $this->attributes['encrypted_password'];
    }

    public function getAuthPasswordName()
    {
        return 'encrypted_password';
    }
    */
}
