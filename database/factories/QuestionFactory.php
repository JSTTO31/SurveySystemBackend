<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $order = 0;

    public function definition()
    {
        if(self::$order > 9){
            self::$order = 0;
        }
        return [
            'text' => str_replace('.', '?', $this->faker->sentence()),
            'survey_id' => 1,
            'index' =>  self::$order++,
        ];
    }
}
