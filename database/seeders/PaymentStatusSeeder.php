<?php

namespace Database\Seeders;

use App\Models\Master\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::truncate();
        $status = ['belum bayar', 'lunas'];
        foreach ($status as $key => $value) {
            PaymentStatus::create(['name' => $value]);
        }
    }
}
