@extends('layouts.admin_master')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Add Marks for Exam: {{ $exam->name }}</h4>

                    <form action="{{ route('exams.addMarks', $exam->id) }}" method="POST">
                        @csrf
                        @foreach ($students as $student)
                            <div class="form-group">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-12" style="border: 1px solid black; padding: 15px 5px 5px 5px; border-radius: 8px;">
                                            <!-- Student Name and User ID -->
                                            <div class="row">
                                                <!-- Student Info Column (3) centered vertically and horizontally -->
                                                <div class="col-3 d-flex align-items-center justify-content-center">
                                                    <label class="font-weight-bold text-center" style="font-size: 18px;">{{ $student->student_name }} -
                                                        {{ $student->dhakila_number }}</label>
                                                </div>

                                                <!-- Subjects and Marks Input Fields Column (9) -->
                                                <div class="col-9">
                                                    <div class="row">
                                                        @foreach ($subjects as $subject)
                                                            <!-- Each Subject Input Field will take up 4 columns for medium screens -->
                                                            <div class="col-md-4 mb-3">
                                                                <div class="form-group">
                                                                    <label>{{ $subject->name }}</label>
                                                                    <input type="number"
                                                                        name="marks[{{ $student->id }}][{{ $subject->id }}]"
                                                                        class="form-control"
                                                                        value="{{ old('marks.' . $student->id . '.' . $subject->id, isset($results[$student->id . '_' . $subject->id]) ? $results[$student->id . '_' . $subject->id]->marks : '') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-success mt-3">Submit Marks</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection