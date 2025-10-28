@extends('layouts.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between align-items-center">
            <h4 class="page-title">Edit Course</h4>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to Courses</a>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title',$course->title) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug',$course->slug) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" value="{{ old('price',$course->price) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration <span class="text-danger">*</span></label>
                            <input type="text" name="duration" class="form-control" value="{{ old('duration',$course->duration) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @if($course->image)
                                <img src="{{ asset('uploads/courses/'.$course->image) }}" width="100" class="mt-2">
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teachers <span class="text-danger">*</span></label>
                            <select name="teachers[]" class="form-control" multiple required>
                                @foreach($allTeachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ $course->teachers->pluck('id')->contains($teacher->id)?'selected':'' }}>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3">{{ old('short_description',$course->short_description) }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Long Description</label>
                            <textarea name="long_description" class="form-control" rows="5">{{ old('long_description',$course->long_description) }}</textarea>
                        </div>

                        <!-- Dynamic Topics -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Topics</label>
                            <div id="topic-wrapper">
                                @foreach($course->topics as $topic)
                                    <div class="input-group mb-2 topic-row">
                                        <input type="text" name="new_topics[][name]" class="form-control" value="{{ $topic->name }}" placeholder="Enter topic name" required>
                                        <input type="text" name="new_topics[][note]" class="form-control" value="{{ $topic->note }}" placeholder="Enter note (optional)">
                                        <button type="button" class="btn btn-danger remove-topic">-</button>
                                    </div>
                                @endforeach
                                <!-- Optionally, add one empty row for new topics -->
                                <div class="input-group mb-2 topic-row">
                                    <input type="text" name="new_topics[][name]" class="form-control" placeholder="Enter topic name">
                                    <input type="text" name="new_topics[][note]" class="form-control" placeholder="Enter note (optional)">
                                    <button type="button" class="btn btn-success add-topic">+</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Update Course</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    // Add new topic input dynamically
    $(document).on('click','.add-topic', function(){
        let html = `<div class="input-group mb-2 topic-row">
                        <input type="text" name="new_topics[][name]" class="form-control" placeholder="Enter topic name" required>
                        <input type="text" name="new_topics[][note]" class="form-control" placeholder="Enter note (optional)">
                        <button type="button" class="btn btn-danger remove-topic">-</button>
                    </div>`;
        $('#topic-wrapper').append(html);
    });

    // Remove topic input
    $(document).on('click','.remove-topic', function(){
        $(this).closest('.topic-row').remove();
    });
});
</script>


@endsection


