<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configurations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_title'
    ];

    public static function getConfiguration()
    {
        $configuration = Configuration::where('id', '>', 0)->first();
        if (!$configuration) {
            Configuration::create(['website_title' => '']);
            $configuration = Configuration::where('id', '>', 0)->first();
        }

        return $configuration;
    }
}
