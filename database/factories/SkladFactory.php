<?php

namespace Database\Factories;
use App\Models\Sklad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sklad>
 */
class SkladFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'short_description' => $this->faker->sentence,
            'availability' => $this->faker->text,
        ];
    }
    protected $model = Sklad::class;
}
