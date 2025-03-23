<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'sex',
        'region',
        'office_id',
        'service_id',
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

    public function office()
{
    return $this->belongsTo(Offices::class, 'office_id');
}

public function service()
{
    return $this->belongsTo(Services::class, 'service_id');
}

}
