<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {
        return [
            'class_id' => 1,
            'section_name' => $this->faker->randomElement(['أ','ب','ج']),
            'section_capacity' => $this->faker->numberBetween(20, 40),
            'teacher_id' => 1,
        ];
    }
}
