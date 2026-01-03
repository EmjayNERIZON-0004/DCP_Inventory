<?php

namespace Database\Factories\SchoolEquipment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolEquipment\SchoolEquipmentAllotmentClass>
 */
class SchoolEquipmentAllotmentClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(), // example: "Class A"
        ];
    }
}
