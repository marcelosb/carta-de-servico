<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    /**
     * Lê-se: este usuário (this) pertence a muitas (belongsToMany) permissões (Permission::class)
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permission');
    }

    /**
     * Retornas todas as permissões do usuário
     * 
     * @return array  $permissions
     */
    public static function getPermissions()
    {
        $permissions = [];
        foreach (Auth::user()->permissions as $permission) {
            $permissions[] = $permission->name;
        }

        return $permissions;
    }

}
