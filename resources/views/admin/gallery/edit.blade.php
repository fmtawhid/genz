@extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Edit Gallery</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('gallery') }}" class="btn btn-primary">Gallery List</a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Form to update the gallery item -->
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- This is required for PUT requests -->

                    <div class="row">
                        <!-- Note (Optional) -->
                        <div class="mb-3 col-md-6">
                            <label for="note" class="form-label">Note</label>
                            <input class="form-control" name="note" value="{{ old('note', $gallery->note) }}"
                                type="text" id="note" placeholder="Enter Note">
                            @error('note')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="date" value="{{ old('date', $gallery->date) }}"
                                type="date" id="date" required>
                            @error('date')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Image -->
                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image (Optional)</label>
                            <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            @error('image')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                            @if ($gallery->image)
                            <div class="mt-3">
                                <label>Current Image:</label>
                                <img src="{{ asset('img/galleries/'. $gallery->image) }}" alt="Gallery Image"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn btn-primary">Update Gallery</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->

@endsection