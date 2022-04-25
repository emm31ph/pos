<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'itemcode' => sprintf('%011d', $this->faker->unique()->numberBetween(1, 11000)),
            'fulltitle' => $this->faker->title(20),
            'fulldesc' => $this->faker->title(50),
            'barcode' => sprintf('%011d', $this->faker->unique()->numberBetween(1, 11000)),
            'uom' => 'U00CS',
            'size' => 100,
        ];
    }
}
