@extends('layouts.admin_master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Student Reviews</h4>
  <a href="{{ route('reviews.create') }}" class="btn btn-primary">
    <i class="ri-add-circle-line"></i> Add Review
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
  <div class="card-body table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Student</th>
          <th>Position</th>
          <th>Course</th>
          <th>Image</th>
          <th>Video</th>
          <th>Created</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reviews as $i => $review)
          <tr>
            <td>{{ $reviews->firstItem() + $i }}</td>
            <td>{{ $review->student_name }}</td>
            <td>{{ $review->position_name }}</td>
            <td>{{ $review->course?->title }}</td>
            <td>
              <img src="{{ $review->photo_url }}" alt="photo" style="width:48px;height:48px;object-fit:cover;border-radius:6px;">
            </td>
            <td>
              @if($review->video_url)
                <a href="{{ $review->video_url }}" target="_blank" class="btn btn-outline-secondary btn-sm">Open</a>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td>{{ $review->created_at?->diffForHumans() }}</td>
            <td class="text-end">
              <a href="{{ route('reviews.edit', $review) }}" class="btn btn-info btn-sm">Edit</a>
              <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline-block"
                    onsubmit="return confirm('Delete this review?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="8" class="text-center text-muted">No reviews found.</td></tr>
        @endforelse
      </tbody>
    </table>

    <div class="mt-3">
      {{ $reviews->links() }}
    </div>
  </div>
</div>
@endsection
