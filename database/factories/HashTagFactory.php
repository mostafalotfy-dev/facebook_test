<?php

namespace Database\Factories;

use App\Models\HashTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class HashTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HashTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'user_id' => $this->faker->word,
        'postable_type' => $this->faker->word,
        'postable_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
