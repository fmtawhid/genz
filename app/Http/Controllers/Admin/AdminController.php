<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Course;
use App\Models\Merchant;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    public function index()
    {
        $monthStarts = collect(range(5, 0))->map(
            fn (int $monthsAgo) => now()->subMonths($monthsAgo)->startOfMonth()
        );
        $chartStart = $monthStarts->first();

        $admissions = Admission::where('created_at', '>=', $chartStart)->get();
        $reviews = Review::where('created_at', '>=', $chartStart)->get();

        $monthLabels = $monthStarts->map(fn (Carbon $month) => $month->format('M Y'));
        $admissionsByMonth = $this->countByMonth($admissions, $monthStarts);
        $reviewsByMonth = $this->countByMonth($reviews, $monthStarts);

        return view('admin.index', [
            'stats' => [
                'students' => Merchant::count(),
                'activeStudents' => Merchant::where('status', 'active')->count(),
                'courses' => Course::count(),
                'pendingAdmissions' => Admission::where('status', 'pending')->count(),
                'reviews' => Review::count(),
                'averageRating' => round((float) (Review::avg('rating') ?? 0), 1),
            ],
            'chartData' => [
                'labels' => $monthLabels->values(),
                'admissions' => $admissionsByMonth,
                'reviews' => $reviewsByMonth,
                'ratings' => collect(range(5, 1))->mapWithKeys(
                    fn (int $rating) => [$rating => Review::where('rating', $rating)->count()]
                ),
            ],
            'recentReviews' => Review::latest()->take(4)->get(),
        ]);
    }

    private function countByMonth(Collection $records, Collection $monthStarts): Collection
    {
        return $monthStarts->map(function (Carbon $month) use ($records) {
            return $records->filter(
                fn ($record) => $record->created_at?->isSameMonth($month)
            )->count();
        })->values();
    }
}
