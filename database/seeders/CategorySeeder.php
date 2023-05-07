<?php

namespace Database\Seeders;

use App\Models\Master\category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::truncate();
        $status = ['ktp', 'kia'];
        foreach ($status as $key => $value) {
            category::create(['name' => $value]);
        }
    }
}
