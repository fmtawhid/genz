@extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Add Notice</h4>
            <ol class="breadcrumb m-0">
                @can('notice_view')
                <li class="breadcrumb-item">
                    <a href="{{ route('notices.list') }}" class="btn btn-primary"> Notice List </a>
                </li>
                @endcan
            </ol>
        </div>
    </div>
</div>
<!-- End page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('notices.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Notice Title -->
                        <div class="mb-3 col-md-6">
                            <label for="section_title" class="form-label">Notice Title <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" name="section_title" value="{{ old('section_title') }}"
                                type="text" id="section_title" placeholder="Enter Notice Title" required>
                            @error('section_title')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="date" value="{{ old('date') }}" placeholder="dd-mm-yy"
                                type="text" id="date" required>
                            @error('date')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Description -->
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description <span
                                class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description" rows="4"
                                placeholder="Enter Notice Description" required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <!-- Teacher Image -->
                        <div class="mb-3 col-md-6">
                            <label for="pdf_file" class="form-label">PDF Upload </label>
                            <input class="form-control" type="file" name="pdf_file" id="pdf_file" accept="pdf_file/*"
                                >
                            @error('image')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->


@endsection

@section('scripts')
<script>
$("#date").flatpickr({
    dateFormat: "d-m-Y",
    placeholder: 'dd/mm/yy'
})
</script>
@endsection