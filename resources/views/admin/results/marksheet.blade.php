
@extends('layouts.admin_master')
@section('content')
<div class="container mt-4">
    <div class="card">

        <div class="card-body">
            <h3 class="text-center mb-4">Marksheet</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Student Name:</strong> {{ $student->student_name }}<br>
                    <strong>Roll Number:</strong> {{ $student->roll_number }}<br>
                    <strong>Class:</strong> {{ $student->sreni->name ?? '' }}<br>
                    <strong>Department:</strong> {{ $student->bibag->name ?? '' }}
                </div>
                <div class="col-md-6 text-end">
                    <strong>Exam:</strong> {{ $exam->name }}<br>
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($exam->date ?? now())->format('d-m-Y') }}
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        function getGrade($marks) {
                            if ($marks >= 80) return 'A+';
                            if ($marks >= 70) return 'A';
                            if ($marks >= 60) return 'A-';
                            if ($marks >= 50) return 'B';
                            if ($marks >= 40) return 'C';
                            if ($marks >= 33) return 'D';
                            return 'F';
                        }
                    @endphp
                    @foreach($results as $result)
                        @php $total += $result->marks; @endphp
                        <tr>
                            <td>{{ $result->subject->name ?? '' }}</td>
                            <td>{{ $result->marks }}</td>
                            <td>{{ getGrade($result->marks) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>{{ $total }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="mt-3 text-end">
                <strong>Printed on:</strong> {{ now()->format('d-m-Y h:i A') }}
            </div>
        </div>
    </div>
</div>
@endsection