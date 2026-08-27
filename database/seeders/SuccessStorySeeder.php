<?php

namespace Database\Seeders;

use App\Models\SuccessStory;
use Illuminate\Database\Seeder;

class SuccessStorySeeder extends Seeder
{
    public function run(): void
    {
        $successStories = [
            [
                'title' => 'From Beginner to Professional Web Designer',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'note' => 'Completed the web design course and started working with real clients.',
            ],
            [
                'title' => 'Landing a First Freelancing Project',
                'youtube_url' => 'https://www.youtube.com/watch?v=ScMzIvxBSi4',
                'note' => 'Built a strong portfolio and received the first international freelancing order.',
            ],
            [
                'title' => 'Building a Successful E-commerce Career',
                'youtube_url' => 'https://www.youtube.com/watch?v=ysz5S6PUM-U',
                'note' => 'Learned e-commerce website development and launched a store for a local business.',
            ],
            [
                'title' => 'Career Change into Laravel Development',
                'youtube_url' => 'https://www.youtube.com/watch?v=rfscVS0vtbw',
                'note' => 'Moved from a non-technical background into a full-time backend development role.',
            ],
            [
                'title' => 'Growing a Business with Digital Marketing',
                'youtube_url' => 'https://www.youtube.com/watch?v=nU-IIXBWlS4',
                'note' => 'Used digital marketing skills to grow online reach and generate consistent leads.',
            ],
            [
                'title' => 'Starting a Career in UI/UX Design',
                'youtube_url' => 'https://www.youtube.com/watch?v=Ovj4hFxko7c',
                'note' => 'Created a professional UI/UX portfolio and joined a creative design team.',
            ],
        ];

        foreach ($successStories as $successStory) {
            SuccessStory::firstOrCreate(
                ['title' => $successStory['title']],
                $successStory
            );
        }
    }
}
