<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_categories extends Model
{
    use HasFactory;
    protected $table='vehicle_categories';
    protected $primaryKey='id';

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'image',
    ];

}
