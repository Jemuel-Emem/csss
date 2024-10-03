<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'age',
        'sex',
        'region',
        'agency_visited',
        'service_availed',
        'customer_type',
        'cc1',
        'cc2',
        'cc3',
        'sqd1',
        'sqd2',
        'sqd3',
        'sqd4',
        'sqd5',
        'sqd6',
        'sqd7',
        'sqd8',
        'remarks',
    ];
}
