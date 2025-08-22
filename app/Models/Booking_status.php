<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_status extends Model
{
    use HasFactory;
    protected $table='booking_statuses';
    protected $primaryKey='id';
    protected $fillable = [
        'bid',
        'booking_reference',
        'status',
        'admin_notes',
    ];
    // protected $casts = [
    //     'booking_date' => 'string',
    //     'pickup_date' => 'string',
    //     'dropoff_date' => 'string',
    //     'updated_pickup_date' => 'string',
    //     'updated_dropoff_date' => 'string',
    // ];
}
