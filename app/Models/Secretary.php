<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'secretaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'theme',
        'theme_slug',
        'address',
        'telephone',
        'email',
        'opening_hours',
        'icon'
    ];

    /**
     * Lê-se: esta secretaria (this) tem muitos (hasMany) serviços (Service::class)
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'secretary_id');
    }

}
