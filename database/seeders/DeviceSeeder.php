<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run()
    {
        Device::create([
            'name' => 'Printer LaserJet',
            'paper_size' => 'A4',
            'print_resolution' => '1200 x 1200 dpi',
            'print_speed' => '20 ppm',
            'print_result' => 'Monochrome',
            'capacity' => '10,000 pages/month',
            'recommended_volume' => '2,000 - 5,000 pages/month',
            'power_consumption' => '500 W',
            'connectivity' => 'WiFi, USB',
            'stock' => 10,
            'rental_price' => 500000.00,
            'available' => true,
        ]);
    }
}
