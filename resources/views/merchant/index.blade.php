@extends('merchant.layout.layout')  {{-- or your merchant layout path --}}

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Student Dashboard</h2>
                <p class="text-gray-600 mt-1">Welcome back, {{ auth()->user()->name }}!</p>
            </div>

            <!-- Stats Cards (Student specific) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Enrolled Courses</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $enrolledCoursesCount ?? 0 }}</p>
                        </div>
                        <div class="bg-green-100 p-2 md:p-3 rounded-full">
                            <i class="fas fa-book-open text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-xs text-green-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> +2 this month</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-blue-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Completed Lessons</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $completedLessonsCount ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                            <i class="fas fa-check-circle text-blue-600"></i>
                        </div>
                    </div>
                    <p class="text-xs text-blue-600 mt-2"><i class="fas fa-chart-line mr-1"></i> {{ $completionRate ?? 0 }}% of total</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-purple-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Average Progress</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $averageProgress ?? 0 }}%</p>
                        </div>
                        <div class="bg-purple-100 p-2 md:p-3 rounded-full">
                            <i class="fas fa-chart-simple text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-xs text-purple-600 mt-2"><i class="fas fa-clock mr-1"></i> Keep going!</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-orange-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Pending Assignments</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $pendingAssignments ?? 0 }}</p>
                        </div>
                        <div class="bg-orange-100 p-2 md:p-3 rounded-full">
                            <i class="fas fa-tasks text-orange-600"></i>
                        </div>
                    </div>
                    <p class="text-xs text-orange-600 mt-2"><i class="fas fa-exclamation-circle mr-1"></i> Due soon</p>
                </div>
            </div>

            <!-- Recent Courses and Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                <!-- My Recent Courses -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 md:p-5">
                    <div class="flex justify-between items-center mb-4 md:mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">My Recent Courses</h3>
                        <a href="{{ route('merchant.courses.index') }}" class="text-sm text-primary-600 hover:underline">View all</a>
                    </div>
                    @forelse($recentCourses ?? [] as $course)
                        <div class="flex items-center space-x-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                @if($course->thumbnail)
                                    <img src="{{ asset($course->thumbnail) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">{{ $course->title }}</h4>
                                <div class="flex items-center mt-1">
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary-600 rounded-full" style="width: {{ $course->progress ?? 0 }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">{{ $course->progress ?? 0 }}%</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">{{ $course->lessons_count ?? 0 }} lessons</p>
                            </div>
                            <a href="{{ route('merchant.courses.show', $course->id) }}" class="text-primary-600 hover:text-primary-700">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-book-open text-4xl mb-2"></i>
                            <p>You haven't enrolled in any courses yet.</p>
                            <a href="#" class="inline-block mt-2 text-primary-600">Browse courses →</a>
                        </div>
                    @endforelse
                </div>

                <!-- Upcoming Deadlines / Activities -->
                <div class="bg-white rounded-xl shadow-sm p-4 md:p-5">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 md:mb-6">Upcoming Deadlines</h3>
                    <div class="space-y-4">
                        @forelse($deadlines ?? [] as $deadline)
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100 last:border-0">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $deadline->title }}</p>
                                    <p class="text-xs text-gray-500">{{ $deadline->course->title ?? 'Course' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-medium {{ $deadline->days_left <= 2 ? 'text-red-600' : 'text-yellow-600' }}">
                                        {{ $deadline->days_left }} days left
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm text-center py-4">No upcoming deadlines. Enjoy your day!</p>
                        @endforelse
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total study time this week</span>
                        <span class="font-semibold text-gray-800">{{ $studyTimeThisWeek ?? 0 }} hrs</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Feed -->
            <div class="mt-6 bg-white rounded-xl shadow-sm p-4 md:p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <div class="space-y-3">
                    @forelse($activities ?? [] as $activity)
                        <div class="flex items-start space-x-3">
                            <div class="mt-1">
                                <i class="fas fa-{{ $activity->icon ?? 'play-circle' }} text-primary-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-700">{{ $activity->description }}</p>
                                <p class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm text-center py-4">No recent activity yet. Start learning!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection