<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rates extends Model
{
    protected $fillable = [
        'name',
        'verysatisfied',
        'satisfied',
        'neithersatisfied',
        'dissatisfied',
        'notapplicable'
    ];
    use HasFactory;
}
