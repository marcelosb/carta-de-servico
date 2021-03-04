<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'user_permission');
    // }

    /**
     * Retornas todas as permissões do usuário
     * 
     * @return array  $permissions
     */
    public static function getPermissions()
    {
        // $permissions = [];
        // foreach (Auth::user()->permissions as $permission) {
        //     $permissions[] = $permission->name;
        // }

        // return $permissions;
    }

    /**
     * Lê-se: este usuário (this) pertence a muitos (belongsToMany) perfis (Role::class)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * Lê-se: este perfil (this) pertence a muitas (belongsToMany) permissões (Permission::class)
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public static function createRelationshipWithRole($roleId, $permissionId)
    {
        DB::table('user_role')->insert([
            'user_id' => $roleId,
            'role_id' => $permissionId
        ]);
    }

    public static function updateRelationshipWithRole($roleId, $permissionId)
    {
        DB::table('user_role')->insert([
            'user_id' => $roleId,
            'role_id' => $permissionId
        ]);
    }

}
