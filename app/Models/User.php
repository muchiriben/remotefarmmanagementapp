<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'national_id',
        'profile_image',
        'description',
        'location',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    //check user roles
    public function hasAnyRoles(array $roles)
    {

        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function hasAnyRole(string $role)
    {

        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }
}
