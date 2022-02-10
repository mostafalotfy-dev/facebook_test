<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'phone_number_verified_at' => $this->faker->date('Y-m-d H:i:s'),
        'password' => $this->faker->word,
        'verify_number' => $this->faker->word,
        'avatar' => $this->faker->word,
        'provider_id' => $this->faker->randomDigitNotNull,
        'provider_token' => $this->faker->word,
        'provider_name' => $this->faker->word,
        'description' => $this->faker->word,
        'user_ip' => $this->faker->word,
        'remember_token' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
