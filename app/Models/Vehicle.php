<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table='vehicles';
    protected $primaryKey='id';
    protected $guarded = [];

    // protected $fillable = [
    //     'name',
    //     'parent_id',
    //     'description',
    //     'image',
    // ];
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vid','id');
    }
}
