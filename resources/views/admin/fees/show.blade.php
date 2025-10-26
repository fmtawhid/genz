@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Fee Details</h4>
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
                    <h5><strong>Fee Type:</strong> {{ $fee->fee_type }}</h5>
                    <h5><strong>Label:</strong> {{ $fee->label }}</h5>
                    <h5><strong>Amount:</strong> {{ $fee->amount }}</h5>
                    <h5><strong>Optional:</strong> {{ $fee->is_optional ? 'Yes' : 'No' }}</h5>

                    <h4 class="mt-4">Assigned Students</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fee->assignedFees as $assignedFee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $assignedFee->student->name }}</td>
                                    <td>{{ $assignedFee->month }}</td>
                                    <td>{{ $assignedFee->amount }}</td>
                                    <td>
                                        <span class="badge {{ $assignedFee->is_paid ? 'badge-success' : 'badge-warning' }}">
                                            {{ $assignedFee->is_paid ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('assignedFees.pay', $assignedFee->id) }}" class="btn btn-success">Mark as Paid</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('fees.assign', $fee->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="student_id">Select Student</label>
                            <select name="student_id" id="student_id" class="form-control" required>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="month">Month</label>
                            <input type="text" name="month" id="month" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Assign Fee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
