@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12 mt-2">
            <h4>Student Due Fees Details</h4>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Student Name: {{ $student->student_name }}</h5>
                    <p><strong>Class:</strong> {{ $student->sreni_name }}</p>
                    <p><strong>Bibhag:</strong> {{ $student->bibag_name }}</p>
                    <p><strong>Total Due Fee:</strong> {{ $student->total_due }}</p>
                    <p><strong>Total Payments Made:</strong> {{ $payments }}</p>
                    <p><strong>Total Due After Payment:</strong> {{ $student->total_due_after_payment }}</p>

                    <!-- Table for Assigned Fees -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fee Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->assignedFees as $fee)
                                <tr>
                                    <td>{{ $fee->feeCategory->category_name ?? $fee->optionalService->service_type ?? '' }} - {{ \Carbon\Carbon::parse($fee->created_at)->format('F Y') }}</td>
                                    <td>{{ $fee->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('students.due') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
