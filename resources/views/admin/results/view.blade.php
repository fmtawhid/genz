@extends('layouts.admin_master')

@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Filter & View Results</h3>

                        <!-- Filter Form -->
                        <form action="{{ route('results.view') }}" method="GET" class="row mb-4">
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
                                        <option value="{{ $bibag->id }}" {{ request('bibag_id') == $bibag->id ? 'selected' : '' }}>
                                            {{ $bibag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="sreni_id" class="form-label">Class</label>
                                <select name="sreni_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($srenis as $sreni)
                                        <option value="{{ $sreni->id }}" {{ request('sreni_id') == $sreni->id ? 'selected' : '' }}>
                                            {{ $sreni->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="subject_id" class="form-label">Subject</label>
                                <select name="subject_id" class="form-control">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 align-self-end mt-2">
                                <button type="submit" class="btn btn-primary ">Filter Results</button>
                                <a href="{{ route('results.export.pdf', ['exam_id' => request('exam_id'), 'bibag_id' => request('bibag_id'), 'sreni_id' => request('sreni_id'), 'subject_id' => request('subject_id')]) }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>
                            </div>
                        </form> 

                        <!-- Export Buttons -->
                        

                        <!-- Results Table -->
                        @if($examId && $subjectId)
                            <h4 class="mb-4">Results</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Roll Number</th>
                                        <th>Subject</th>
                                        <th>Marks</th>
                                        <th>Position</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sortedStudents = $students->sortByDesc('marks');
                                        $rank = 1;
                                    @endphp
                                    @foreach($sortedStudents as $index => $student)
                                        <tr>
                                            <td>{{ $student->student_name }}</td>
                                            <td>{{ $student->roll_number }}</td>
                                            <td>{{ $subjectName }}</td>
                                            <td>{{ $student->marks ?? '' }}</td>
                                            <td>
                                                @if ($index > 0 && $student->marks == $sortedStudents[$index - 1]->marks)
                                                    {{ $rank }}th
                                                @else
                                                    {{ $rank++ }}th
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @elseif($examId && !$subjectId)
                            <h4 class="mb-4">Total Marks for All Subjects</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Roll Number</th>
                                        <th>Total Marks</th>
                                        <th>Position</th>
                                        <th>Markheet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sortedStudents = $students->sortByDesc('total_marks');
                                        $rank = 1;
                                    @endphp
                                    @foreach($sortedStudents as $index => $student)
                                        <tr>
                                            <td>{{ $student->student_name }}</td>
                                            <td>{{ $student->roll_number }}</td>
                                            <td>{{ $student->total_marks }}</td>
                                            <td>
                                                @if ($index > 0 && $student->total_marks == $sortedStudents[$index - 1]->total_marks)
                                                    {{ $rank }}th
                                                @else
                                                    {{ $rank++ }}th
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('student.marksheet', ['student_id' => $student->id, 'exam_id' => $examId]) }}" 
                                                class="btn btn-sm btn-info" target="_blank">
                                                    Marksheet
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                Please select an Exam and Subject to view results.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
