<?php

namespace Database\Seeders;

use App\Models\Master\ShippmentStatus;
use Illuminate\Database\Seeder;

class ShipmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippmentStatus::truncate();
        $status = ['dikemas', 'terkirim', 'dibatalkan'];
        foreach ($status as $key => $value) {
            ShippmentStatus::create(['name' => $value]);
        }
    }
}
