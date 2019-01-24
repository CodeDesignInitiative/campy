<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampyWeb extends Model
{
    protected $table = 'campy_web';

    protected $fillable = [
        'route',
        'request',
    ];

    protected $casts = [
        'request' => 'array',
    ];
}
