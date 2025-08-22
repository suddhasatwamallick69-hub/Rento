<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile_details extends Model
{
    use HasFactory;
    protected $table='profile_details';
    protected $primaryKey='id';
    protected $fillable = [
        'uid',
        'driving_license',
        'aadhar_number',
    ];
}
