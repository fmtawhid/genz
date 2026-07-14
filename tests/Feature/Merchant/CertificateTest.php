<?php

namespace Tests\Feature\Merchant;

use App\Models\Admission;
use App\Models\Course;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificateTest extends TestCase
{
    use RefreshDatabase;

    public function test_merchant_can_view_their_certificates(): void
    {
        $user = User::factory()->create([
            'role' => 'merchant',
        ]);

        $merchant = Merchant::create([
            'user_id' => $user->id,
            'name' => 'Test Merchant',
            'email' => 'merchant@example.com',
            'phone' => '01700000000',
            'address' => 'Dhaka',
            'status' => 'active',
            'verified' => true,
        ]);

        $course = Course::create([
            'title' => 'Laravel Basics',
            'slug' => 'laravel-basics',
            'description' => 'Learn Laravel basics',
            'price' => 1000,
            'discount' => 0,
            'thumbnail' => null,
            'level' => 'beginner',
            'duration' => '4 weeks',
            'status' => 'published',
        ]);

        Admission::create([
            'user_id' => $user->id,
            'merchant_id' => $merchant->id,
            'course_id' => $course->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '01700000000',
            'goal' => 'Learn Laravel',
            'status' => 'approved',
        ]);

        $response = $this->actingAs($user)->get(route('merchant.certificates.index'));

        $response->assertOk();
        $response->assertSeeText('My Certificates');
        $response->assertSeeText('Laravel Basics');
    }
}
