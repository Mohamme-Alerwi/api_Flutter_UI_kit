<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'role' => 'teacher',
            'email' => $this->faker->unique()->safeEmail(),
            // 'password' => bcrypt('password'),
            'password' => 'password',
            'specialization' => $this->faker->randomElement(['Math', 'Science', 'English', 'Arabic']),
            'phone' => $this->faker->phoneNumber(),
            'class_id' => 1,
            'hire_date' => $this->faker->date(),
            'salary' => $this->faker->numberBetween(2000, 5000),
            'qualification' => $this->faker->randomElement(['Bachelor', 'Master', 'PhD']),
            'photo_url' => $this->faker->imageUrl(200, 200, 'people'),
            'is_active' => true,
            'user_id' => 1,
        ];
    }
}
