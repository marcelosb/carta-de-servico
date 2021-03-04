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
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public static function createPermission($roleId, $permissionId)
    {
        DB::table('role_permission')->insert([
            'role_id' => $roleId,
            'permission_id' => $permissionId
        ]);
    }

    public static function deletePermissionsOld($roleId)
    {
        DB::table('role_permission')->where('role_id', $roleId)->delete();
    }
}
