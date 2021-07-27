<?php

namespace Database\Factories;

use App\Models\comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class commentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'datetime'=>$this->faker->dateTime(),
            'content'=>$this->faker->paragraph(),
            'user_id'=>$this->faker->numberBetween(1,30),
            'post_id'=>$this->faker->numberBetween(1,30),
            'name_id'=>$this->faker->name(),
        ];
    }
}
