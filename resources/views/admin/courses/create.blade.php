@extends('layouts.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between align-items-center">
            <h4 class="page-title">Add Course</h4>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to Courses</a>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                            @error('slug') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration <span class="text-danger">*</span></label>
                            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" required>
                            @error('duration') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teachers <span class="text-danger">*</span></label>
                            <select name="teachers[]" class="form-control" multiple required>
                                @foreach($allTeachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            @error('teachers') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Long Description</label>
                            <textarea name="long_description" class="form-control" rows="5">{{ old('long_description') }}</textarea>
                        </div>

                        <!-- Dynamic Topics -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Topics</label>
                            <div id="topic-wrapper">
                                <div class="input-group mb-2 topic-row">
                                    <input type="text" name="new_topics[][name]" class="form-control" placeholder="Enter topic name" required>
                                    <input type="text" name="new_topics[][note]" class="form-control" placeholder="Enter note (optional)">
                                    <button type="button" class="btn btn-success add-topic">+</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Create Course</button>
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

    // Trim long_description before submit
    $('form').on('submit', function(){
        let $ta = $(this).find('textarea[name="long_description"]');
        if($ta.length){
            $ta.val($.trim($ta.val()));
        }
    });
});
</script>

@endsection
