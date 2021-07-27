<?php

namespace Database\Factories;

use App\Models\post;
use Illuminate\Database\Eloquent\Factories\Factory;

class postFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word(4),
            'content'=>$this->faker->paragraph(),
            'date_written'=>$this->faker->dateTime(),
            'post_imge'=>$this->faker->imageUrl(),
            'votes_up'=>$this->faker->numberBetween(1,50),
            'votes_down'=>$this->faker->numberBetween(1,50),
            'category_id'=>$this->faker->numberBetween(1,10),
            'user_id'=>$this->faker->numberBetween(1,30),
        ];
    }
}
