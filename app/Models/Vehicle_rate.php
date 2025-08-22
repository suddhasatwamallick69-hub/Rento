<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_rate extends Model
{
    use HasFactory;
    protected $table='vehicle_rate';
    protected $primaryKey='id';
    protected $fillable = [
        'vid',
        'rate_per_hour',
    ];
    protected $casts = [
        'rate_per_hour' => 'string',
    ];
}
