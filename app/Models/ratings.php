<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'sex',
        'region',
        'agency_visited',
        'service_availed',
        'customer_type',
        'cc1',
        'cc2',
        'cc3',
        'sd',
        'd',
        'nad',
        'a',
        'sa',
        'remarks'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
