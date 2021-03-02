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
        'name'
    ];

     /**
     * Lê-se: esta permissão (this) pertence a muitos (belongsToMany) usuários (User::class)
     */
    public function permissions()
    {
        return $this->belongsToMany(User::class, 'user_permission');
    }
}
