@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Edit Fee</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('fees.index') }}" class="btn btn-primary">Back to Fee List</a>
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
                    <form action="{{ route('fees.update', $fee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="fee_type">Fee Type</label>
                            <input type="text" name="fee_type" id="fee_type" class="form-control" value="{{ $fee->fee_type }}" required>
                        </div>
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" name="label" id="label" class="form-control" value="{{ $fee->label }}" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ $fee->amount }}" required>
                        </div>
                        <div class="form-group">
                            <label for="is_optional">Is Optional?</label>
                            <select name="is_optional" id="is_optional" class="form-control" required>
                                <option value="1" {{ $fee->is_optional ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$fee->is_optional ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Fee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
