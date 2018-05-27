<?php

namespace App\Entities;

use App\Traits\JWTSubjectTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Entities
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, JWTSubjectTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @return HasMany
     */
    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * @return BelongsToMany
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Advert::class, 'favorites');
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return !!$this->getAttribute('is_admin');
    }
}
