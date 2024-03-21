<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sell>
 */
class SellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_id' => Seller::factory()->create()->id,
            'amount' => $this->faker->randomFloat(1, 0, 10),
            'commission' => $this->faker->randomFloat(1, 0, 10),
        ];
    }
}
