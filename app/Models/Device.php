<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'paper_size', 'print_resolution', 'print_speed',
        'print_result', 'capacity', 'recommended_volume',
        'power_consumption', 'connectivity', 'stock',
        'rental_price', 'available', 'image'
    ];
}
