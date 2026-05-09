<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;

class CourseLessonSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Web Design Fundamentals',
            'Advanced Web Development',
            'Graphic Design Masterclass',
            'UI/UX Design Basics',
            'Digital Marketing Pro',
            'WordPress Development',
            'Laravel Backend Development',
            'Frontend with Tailwind CSS',
            'E-commerce Website Building',
            'Freelancing Career Guide'
        ];

        foreach ($courses as $title) {

            // =========================
            // COURSE CREATE
            // =========================
            $course = Course::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'description' => $title . ' complete professional course.',

                    'price' => rand(1000, 5000),
                    'discount' => rand(0, 50),

                    'thumbnail' => null,

                    'level' => ['beginner', 'intermediate', 'advanced'][rand(0, 2)],

                    // ✅ duration in MINUTES (integer only)
                    'duration' => rand(600, 3600), // 10h - 60h

                    'status' => 'published',
                ]
            );

            // =========================
            // LESSONS CREATE (20 per course)
            // =========================
            for ($i = 1; $i <= 20; $i++) {

                Lesson::firstOrCreate(
                    [
                        'course_id' => $course->id,
                        'order' => $i
                    ],
                    [
                        'title' => $title . " - Lesson " . $i,
                        'description' => "Lesson $i of $title",

                        'video_url' => "https://example.com/video-$i",
                        'content' => "Detailed content for lesson $i of $title",

                        // ✅ duration in minutes
                        'duration' => rand(5, 30),

                        'is_free' => $i === 1 ? 1 : 0,
                    ]
                );
            }
        }
    }
}