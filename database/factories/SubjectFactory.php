<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'subject_name' => $this->faker->randomElement(['Math', 'English', 'Arabic', 'Science']),
            'class_id' => 1,
            'teacher_id' => 1,
        ];
    }
}
