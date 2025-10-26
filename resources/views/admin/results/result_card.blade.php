@extends('layouts.admin_master')

@section('content')
    <div class="container">
        <h3>Student Result Card</h3>

        <div class="result-card">
            <h4>{{ $student->student_name }}</h4>
            <p>Exam: {{ $result->exam->name }}</p>
            <p>Class: {{ $student->sreni->name }}</p>
            <p>Department: {{ $student->bibag->name }}</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Marks Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result->subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $result->marks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button onclick="window.print()" class="btn btn-primary">Print Result Card</button>
        </div>
    </div>
@endsection
