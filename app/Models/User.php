<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'password'
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
     * Lê-se: este usuário (this) pertence a muitos (belongsToMany) perfis (Role::class)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * Verifica se o usuário tem o perfil de Administrador.
     * Caso seja Admin, é liberado o acesso a todos os módulos do sistema.
     * 
     * @return bool
     */
    public static function isAdministrator()
    {
        $role = Auth::user()->roles->pluck('name')->first();
        $admin = config('permissions.role.admin');

        return $role === $admin;
    }

}
