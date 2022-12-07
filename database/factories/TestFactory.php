<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = fake()->randomNumber();
        $results = ['normal', 'illegal', 'failed', 'success'];
        return [
            'script_name' => Str::random(10),
            'start_time' => $number,
            'end_time' => $number + fake()->randomNumber(),
            'result' => $results[array_rand($results, 1)]
        ];
    }
}
