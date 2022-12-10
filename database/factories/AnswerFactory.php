<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $order = 0;

    public function definition()
    {
        if(self::$order > 3){
            self::$order = 0;
        }
        return [
            'text' => $this->faker->randomElement([$this->faker->word(), $this->faker->sentence()]),
            'index' => self::$order++,
        ];
    }
}
