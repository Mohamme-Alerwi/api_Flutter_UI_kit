<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ParentsModel;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Timetable;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // مستخدم أدمن افتراضي
        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => 'admin',
        //     'role' => 'admin',
        // ]);
        User::factory()->count(1)->create();

        // معلمين
        
        // صفوف وشعب
        $class1 = SchoolClass::factory()->create([
            'class_name' => 'اول ابتدائي',
            'academic_year' => '2025-2026',
            'class_capacity' => 60,
        ]);
        Teacher::factory()->count(2)->create();

        Section::factory()->count(2)->create(['class_id' => $class1->id]);

        // طلاب
        Student::factory()->count(10)->create(['class_id' => $class1->id, 'section_id' => 1]);

        // مواد
        Subject::factory()->count(3)->create(['class_id' => $class1->id]);

        // جداول حصص
$days = ['Saturday', 'Sunday', 'Monday', 'Tuesday'];
foreach ($days as $day) {
    Timetable::factory()->create([
        'class_id' => $class1->id,
        'section_id' => 1,
        'teacher_id' => 1,
        'subject_id' => 1,
        'day' => $day,
        'start_time' => '08:00:00',
        'end_time' => '09:00:00'
    ]);
}



       // إنشاء 5 أولياء أمور
        $parents = ParentsModel::factory(5)->create();

        // جلب كل الطلاب
        $students = Student::all();

        foreach ($parents as $parent) {
            // ربط كل ولي أمر مع 1 إلى 3 طلاب عشوائيين
            $parent->students()->attach(
                $students->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

    }
}
