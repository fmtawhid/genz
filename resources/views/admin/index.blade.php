@extends('admin.layout.layout')

@section('content')
    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Students</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">{{ number_format($stats['students']) }}</p>
                    </div>
                    <div class="bg-green-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-user-graduate text-green-600"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 mt-2">{{ number_format($stats['activeStudents']) }} active students</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Pending Admissions</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">{{ number_format($stats['pendingAdmissions']) }}</p>
                    </div>
                    <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-user-clock text-blue-600"></i>
                    </div>
                </div>
                <p class="text-xs text-blue-600 mt-2">Applications waiting for review</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-purple-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Courses</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">{{ number_format($stats['courses']) }}</p>
                    </div>
                    <div class="bg-purple-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-book-open text-purple-600"></i>
                    </div>
                </div>
                <p class="text-xs text-purple-600 mt-2">Courses available in the platform</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-red-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Reviews</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">{{ number_format($stats['reviews']) }}</p>
                    </div>
                    <div class="bg-yellow-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-star text-yellow-600"></i>
                    </div>
                </div>
                <p class="text-xs text-yellow-600 mt-2">Average rating: {{ number_format($stats['averageRating'], 1) }}/5</p>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Student and Review Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 md:p-5">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Platform Activity</h3>
                        <p class="text-xs text-gray-500">Admissions and reviews over the last 6 months</p>
                    </div>
                </div>
                <div class="h-64"><canvas id="activityChart"></canvas></div>
            </div>

            <!-- Review Ratings -->
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Rating Distribution</h3>
                <p class="text-xs text-gray-500 mb-4">How students rate the platform</p>
                <div class="h-48"><canvas id="ratingChart"></canvas></div>
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="mt-6 bg-white rounded-xl shadow-sm p-4 md:p-5">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Recent Reviews</h3>
                    <p class="text-xs text-gray-500">Latest feedback from students</p>
                </div>
                <i class="fas fa-comments text-primary-600"></i>
            </div>
            @if ($recentReviews->isEmpty())
                <p class="text-sm text-gray-500 py-3">No reviews have been submitted yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($recentReviews as $review)
                        <div class="border border-gray-100 rounded-lg p-4">
                            <div class="flex justify-between gap-3">
                                <p class="font-medium text-gray-800">{{ $review->name }}</p>
                                <span class="text-yellow-500 text-sm whitespace-nowrap">
                                    {{ str_repeat('★', min(5, max(0, (int) $review->rating))) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $review->message }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $review->created_at?->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- System Status -->
        <div class="mt-6 bg-white rounded-xl shadow-sm p-4 md:p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gateway Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Primary Gateway</p>
                        <p class="text-xs text-gray-500">Operational</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Backup Gateway</p>
                        <p class="text-xs text-gray-500">Standby</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Security Systems</p>
                        <p class="text-xs text-gray-500">Active</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const chartData = @json($chartData);

        new Chart(document.getElementById('activityChart'), {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Admissions',
                        data: chartData.admissions,
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.12)',
                        fill: true,
                        tension: 0.35
                    },
                    {
                        label: 'Reviews',
                        data: chartData.reviews,
                        borderColor: '#eab308',
                        backgroundColor: 'rgba(234, 179, 8, 0.08)',
                        fill: true,
                        tension: 0.35
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });

        new Chart(document.getElementById('ratingChart'), {
            type: 'doughnut',
            data: {
                labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
                datasets: [{
                    data: Object.values(chartData.ratings),
                    backgroundColor: ['#16a34a', '#84cc16', '#eab308', '#f97316', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
@endsection
     
   