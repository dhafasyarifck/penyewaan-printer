<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'description', 'stock', 'rental_price', 'available'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
