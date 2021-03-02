<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'secretary_id',
        'name',
        'name_slug',
        'description',
        'content',
        'icon'
    ];

    /**
     * Lê-se: este serviço (this) pertence a (belongsTo) uma secretaria (Secretary::class)
     */
    public function secretary()
    {
        return $this->belongsTo(Secretary::class, 'secretary_id');
    }
}
