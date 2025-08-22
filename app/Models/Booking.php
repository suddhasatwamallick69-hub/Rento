<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table='bookings';
    protected $primaryKey='id';
    protected $fillable = [
        'vid',
        'uid',
        'hid',
        'booking_date',
        'pickup_date',
        'dropoff_date',
        'duration',
        'updated_pickup_date',
        'updated_dropoff_date',
        'updated_duration',
        'address',
        'landmark',
        'area',
        'house_no',
        'pincode',
        'city',
    ];
    protected $casts = [
        'booking_date' => 'string',
        'pickup_date' => 'string',
        'dropoff_date' => 'string',
        'updated_pickup_date' => 'string',
        'updated_dropoff_date' => 'string',
    ];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid','id');
    }
}
