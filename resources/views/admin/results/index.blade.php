@extends('layouts.admin_master')

@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Filter & Add Results</h3>

                        <!-- Filter Form -->
                        <form action="{{ route('results.index') }}" method="GET" class="row mb-4">
                            @csrf
                            <div class="col-md-3">
                                <label for="exam_id" class="form-label">Exam</label>
                                <select name="exam_id" class="form-control">
                                    <option value="">Select Exam</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                                            {{ $exam->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="bibag_id" class="form-label">Department</label>
                                <select name="bibag_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach ($bibags as $bibag)
                                        <option value="{{ $bibag->id }}" {{ request('bibag_id') == $bibag->id ? 'selected' : '' }}>{{ $bibag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="sreni_id" class="form-label">Class</label>
                                <select name="sreni_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($srenis as $sreni)
                                        <option value="{{ $sreni->id }}" {{ request('sreni_id') == $sreni->id ? 'selected' : '' }}>{{ $sreni->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="subject_id" class="form-label">Subject</label>
                                <select name="subject_id" class="form-control">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary mt-2">Filter Results</button>
                            </div>
                        </form>

                        @if($examId && $subjectId)
                            <form action="{{ route('results.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ $examId }}">
                                <input type="hidden" name="subject_id" value="{{ $subjectId }}">
                                <h4 class="mb-4">Students List</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Roll Number</th>
                                            <th>Subject</th>
                                            <th>Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->student_name }}</td>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>{{ $subjectName }}</td>
                                                <td>
                                                    <input type="number" name="marks[{{ $student->id }}]" class="form-control"
                                                        value="{{ $student->marks ?? '' }}" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success">Save Results</button>
                            </form>
                        @else
                            <div class="alert alert-info">
                                Please select an Exam and Subject to input marks.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection