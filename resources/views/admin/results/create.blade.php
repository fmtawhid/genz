@extends('layouts.admin_master')

@section('content')
    <div class="container">
        <h3>Add New Result</h3>

        <form method="POST" action="{{ route('results.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="student_id" class="form-label">Student</label>
                <select name="student_id" id="student_id" class="form-control">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->student_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="exam_id" class="form-label">Exam</label>
                <select name="exam_id" id="exam_id" class="form-control">
                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="subject_marks" class="form-label">Subject Marks</label>
                @foreach ($subjects as $subject)
                    <div class="mb-2">
                        <label>{{ $subject->name }}</label>
                        <input type="number" name="subject_marks[{{ $subject->id }}]" class="form-control" required>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success">Save Result</button>
        </form>
    </div>
@endsection
