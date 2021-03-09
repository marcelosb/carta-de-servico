<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Lê-se: este perfil (this) pertence a muitas (belongsToMany) permissões (Permission::class)
     */
    public function permissions()
    {
        return $this->hasOne(Permission::class, 'role_id');
    }

    /**
     * Lê-se: este perfil (this) pertence a muitos (belongsToMany) usuários (User::class)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }

    /**
     * Verifica se existe o perfil de admin cadastrado no sistema.
     * Caso não exista, é criado um perfil de admin.
     * 
     * @return App\Models\Role
     */
    public static function admin()
    {
        $role = Role::where('name', config('permissions.role.admin'))->first();
        if (!isset($role)) {
            $role = Role::create([
                'name' => config('permissions.role.admin'),
                'description' => 'Tem acesso a todos os módulos do sistema'
            ]);
        }

        return $role;
    }

}
