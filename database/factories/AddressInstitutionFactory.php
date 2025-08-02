<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressInstitutionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'institution_id' => 1,
            'country' => $this->faker->country,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'nation' => 'Brasil',
            'street_name' => $this->faker->streetName,
            'complement' => $this->faker->text,
            'number' => $this->faker->buildingNumber,
            'neighborhood' => $this->faker->streetSuffix,
            'postalcode' => $this->faker->postcode
        ];
    }
}
