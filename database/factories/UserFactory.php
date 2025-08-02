<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'user_type_id' => 1,
            'name' => $this->faker->name,
            'status' => true,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'age' => $this->faker->numberBetween(18, 90),
            'cpf' => $this->faker->numerify('###########'),
            'phone' => $this->faker->phoneNumber
        ];
    }
}
