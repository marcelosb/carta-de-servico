<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content'
    ];

    public static function getFaq()
    {
        $faq = Faq::where('id', '>', 0)->first();
        if (!$faq) {
            Faq::create([
                'title' => '',
                'content' => ''
            ]);
            $faq = Faq::where('id', '>', 0)->first();
        }

        return $faq;
    }
}
