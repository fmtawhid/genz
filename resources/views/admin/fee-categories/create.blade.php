@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Create Fee Category</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('fee-categories.index') }}" class="btn btn-primary">
                            <i class="ri-arrow-left-circle-line"></i> Back to Fee Categories
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Fee Category Creation Form -->
                    <form action="{{ route('fee-categories.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Category Name -->
                            <div class="mb-3 col-md-6">
                                <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                <input type="text" id="category_name" name="category_name" class="form-control" required>
                                @error('category_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount -->
                            <div class="mb-3 col-md-6">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" id="amount" name="amount" class="form-control" required>
                                @error('amount')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Fee Type (Monthly/Yearly) -->
                            <div class="mb-3 col-md-6">
                                <label for="is_recurring" class="form-label">Fee Type <span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_recurring" id="monthly" value="0" {{ old('is_recurring') === '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="monthly">Monthly</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_recurring" id="yearly" value="1" {{ old('is_recurring') === '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="yearly">Yearly</label>
                                </div>
                                @error('is_recurring')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sreni (Dropdown) -->
                            <div class="mb-3 col-md-6">
                                <label for="sreni_id" class="form-label">Sreni <span class="text-danger">*</span></label>
                                <select id="sreni_id" name="sreni_id" class="form-control" required>
                                    @foreach($srenis as $sreni)
                                        <option value="{{ $sreni->id }}">{{ $sreni->name }}</option>
                                    @endforeach
                                </select>
                                @error('sreni_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Bibag (Dropdown) -->
                            <div class="mb-3 col-md-6">
                                <label for="bibag_id" class="form-label">Bibag <span class="text-danger">*</span></label>
                                <select id="bibag_id" name="bibag_id" class="form-control" required>
                                    @foreach($bibags as $bibag)
                                        <option value="{{ $bibag->id }}">{{ $bibag->name }}</option>
                                    @endforeach
                                </select>
                                @error('bibag_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
