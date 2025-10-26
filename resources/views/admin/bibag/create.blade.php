@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Add Bibhag</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('bibags.index') }}" class="btn btn-primary"> Bibhag List </a>
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
                    <form  action="{{ route('bibags.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Student Name -->
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Bibhag Name <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="name" value="{{ old('name') }}"
                                    type="text" id="name" placeholder="Enter Bibhag Name" required>
                                @error('name')
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