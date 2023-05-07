<?php

namespace Database\Seeders;

use App\Models\CRM\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            // master summy
            IndoRegionSeeder::class,
            CategorySeeder::class,
            PaymentStatusSeeder::class,
            ShipmentStatusSeeder::class,
            // crm dummy 
            OrderSeeder::class,
        ]);
    }
}
