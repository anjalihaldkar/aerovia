<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'duration',
        'accommodation',
        'start_date',
        'end_date',
        'price_sharing',
        'price_single',
        'discount_returning',
        'discount_early',
        'inst_deposit',
        'inst_1',
        'inst_2',
        'inst_final',
        'inclusions',
        'exclusions',
        'director',
        'director_phone',
        'flights',
        'itinerary'
    ];

    protected $casts = [
        'flights' => 'array',
        'itinerary' => 'array',
    ];
}
