<?php

namespace Database\Factories;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolClassFactory extends Factory
{
 
    protected $model = SchoolClass::class;

    public function definition(): array
    {
        return [
            'class_name' => $this->faker->randomElement(['اول ابتدائي','ثاني ابتدائي','ثالث ابتدائي']),
            'academic_year' => '2025-2026',
            'class_capacity' => $this->faker->numberBetween(20, 60),
        ];
    }
}
