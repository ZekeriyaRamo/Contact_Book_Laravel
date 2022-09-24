<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'street' => fake()->name(),
            'street2' => fake()->name(),
            'state' => fake()->name(),
            'city' => fake()->name(),
            'country' => fake()->name(),
            'vat_num' => fake()->name(),
            'zip' => fake()->name(),
        ];
    }
}
