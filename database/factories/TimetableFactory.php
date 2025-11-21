<?php

namespace Database\Factories;

use App\Models\Timetable;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimetableFactory extends Factory
{
    protected $model = Timetable::class;

    public function definition(): array
    {
        return [
            'class_id' => 1,
            'section_id' => 1,
            'teacher_id' => 1,
            'subject_id' => 1,
            // 'subject' => $this->faker->randomElement(['Math', 'English', 'Arabic', 'Science']),
            'day' => $this->faker->randomElement(['Saturday','Sunday','Monday','Tuesday','Wednesday']),
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
        ];
    }
}
