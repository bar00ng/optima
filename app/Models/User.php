<?php

namespace App\Models;

use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'city',
        'country',
        'postal_code',
        'about_me'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function lop(): HasMany {
        return $this->hasMany(Lop::class, 'mitra_id', 'id');
    }
}
