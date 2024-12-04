<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'device_id',
        'quantity',
        'rental_date',
        'return_date',
        'delivery_date',
        'delivery_time',
        'status',
        'alamat',
        'no_telp',
        'atas_nama',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Device
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
