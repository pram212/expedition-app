<?php

namespace Database\Seeders;

use App\Models\CRM\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(200)->create();
    }
}
