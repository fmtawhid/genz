@extends('layouts.admin_master')

@section('content')
<h4 class="mb-3">Add Student Review</h4>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card">
  <div class="card-body">
    <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Student Name <span class="text-danger">*</span></label>
          <input type="text" name="student_name" class="form-control" value="{{ old('student_name') }}" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Position Name</label>
          <input type="text" name="position_name" class="form-control" value="{{ old('position_name') }}" placeholder="e.g., Frontend Developer">
        </div>

        <div class="col-md-6">
          <label class="form-label">Course <span class="text-danger">*</span></label>
          <select name="course_id" class="form-select" required>
            <option value="">-- Select Course --</option>
            @foreach($courses as $c)
              <option value="{{ $c->id }}" @selected(old('course_id')==$c->id)>{{ $c->title }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Image</label>
          <input type="file" name="image" class="form-control" accept="image/*">
          <small class="text-muted">Max 2MB. jpg, png, gif, svg</small>
        </div>

        <div class="col-md-12">
          <label class="form-label">Video URL</label>
          <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://...">
        </div>

        <div class="col-md-12">
          <label class="form-label">Review Text</label>
          <textarea name="body" class="form-control" rows="4" placeholder="Short review">{{ old('body') }}</textarea>
        </div>
      </div>

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
