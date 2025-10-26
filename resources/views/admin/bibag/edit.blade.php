@extends('layouts.admin_master')

@section('styles')
    <!-- Include any additional CSS if needed -->
@endsection

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Edit Bibhag</h4>
                <a href="{{ route('bibags.index') }}" class="btn btn-primary">Bibhag List</a>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Edit Expense Head Form -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bibags.update', $bibag->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Student Name -->
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Bibhag Name <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="name" value="{{ old('name', $bibag->name) }}" type="text"
                                    id="name" placeholder="Enter Class Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Update Bibhag</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <!-- Include any additional JS if needed -->
@endsection
