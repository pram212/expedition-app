<?php

namespace Database\Factories\CRM;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $district = District::where('regency_id', 3276)->InRandomOrder()->first();
        $village = $district->villages()->inRandomOrder()->first();

        return [
            'register_number' => $this->faker->unique()->creditCardNumber(),
            'id_card' => $this->faker->numberBetween(1, 16),
            'customer_name' => $this->faker->name(),
            'customer_guardian' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'category_id' => $this->faker->numberBetween(1,2),
            'payment_statuses_id' =>$this->faker->numberBetween(1,2),
            'shippment_statuses_id' =>$this->faker->numberBetween(1,3),
            'district_id' => $district->id,
            'village_id' => $village->id,
            'address' => $this->faker->streetAddress(),
        ];
    }
}
