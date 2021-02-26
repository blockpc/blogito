<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'blocked_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'blocked_at' => 'date',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function bloqueado()
    {
        return $this->blocked_at ? Carbon::parse($this->blocked_at)->format('M d, Y') : null;
    }

    public function scopeAllowed($query)
    {
        $all_roles_except_sudo = Role::whereNotIn('name', ['sudo'])->get();
        $user = current_user();
        if( $user->hasRole('sudo') ) {
            return $query;
        } else {
            return $query->role($all_roles_except_sudo);
        }
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
