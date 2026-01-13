<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SensorReading;
use App\Models\Device;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SensorReading>
 */
class SensorReadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SensorReading::class;

    public function definition(): array
    {
        return [
            'device_id'     => Device::inRandomOrder()->value('id') ?? 1,
            'soil_moisture' => $this->faker->randomFloat(2, 20, 90), // %
            'temperature'   => $this->faker->randomFloat(2, 18, 35), // °C
            'humidity'      => $this->faker->randomFloat(2, 30, 95),   // % RH
            'light'         => $this->faker->randomFloat(2, 100, 1000), // lux
            'recorded_at'   => $this->faker->dateTimeBetween('-7 days', 'now'),
        ];
    }
}
