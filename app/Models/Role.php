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

    public static function createPermission($roleId, $codes)
    {
        DB::table('permissions')->insert([
            'role_id' => $roleId,
            'codes' => $codes
        ]);
    }

    public static function updatePermission($roleId, $codes)
    {
        DB::table('permissions')->where('role_id', $roleId)->update([
            'codes' => $codes
        ]);
    }

    public static function deletePermissionsOld($roleId)
    {
        DB::table('role_permission')->where('role_id', $roleId)->delete();
    }
}
