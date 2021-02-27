<?php

namespace Database\Factories;

use App\Models\CapybaraObservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CapybaraObservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CapybaraObservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seen_on' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'city' => $this->faker->randomElement(['Chicago', 'Atlanta', 'New York', 'Houston', 'San Francisco']),
            'wearing_hat' => $this->faker->boolean(42),
        ];
    }
}
