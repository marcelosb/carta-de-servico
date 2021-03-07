<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codes'
    ];

     /**
     * Lê-se: esta permissão (this) pertence a um (belongsTo) perfil (Role::class)
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
