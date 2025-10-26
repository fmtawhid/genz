@extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Edit Notice</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('notices.list') }}" class="btn btn-primary">Notice List</a>
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
                <!-- Form to update the notice -->
                <form action="{{ route('notices.update', $notice->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- This is required for PUT requests -->

                    <div class="row">
                        <!-- Notice Title -->
                        <div class="mb-3 col-md-6">
                            <label for="section_title" class="form-label">Notice Title <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" name="section_title"
                                value="{{ old('section_title', $notice->section_title) }}" type="text"
                                id="section_title" placeholder="Enter Notice Title" required>
                            @error('section_title')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="date" value="{{ old('date',\Carbon\Carbon::parse($notice->date)->format('d-m-Y')) }}" type="text"
                                id="date" required>
                            @error('date')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Description -->
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4"
                                placeholder="Enter Notice Description">{{ old('description', $notice->description) }}</textarea>
                            @error('description')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn btn-primary">Update Notice</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->

@endsection