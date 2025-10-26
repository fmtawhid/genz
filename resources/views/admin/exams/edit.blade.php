@extends('layouts.admin_master')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Edit Exam</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('exams.index') }}" class="btn btn-primary">Exam List</a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- end page title -->

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Exam Name -->
                        <div class="col-md-3 mb-3">
                            <label for="name">Exam Name</label>
                            <input type="text" name="name" value="{{ old('name', $exam->name) }}" required class="form-control">
                        </div>

                        <!-- Exam Date -->
                        <div class="col-md-3 mb-3">
                            <label for="date">Exam Date</label>
                            <input type="date" name="date" value="{{ old('date', $exam->date) }}" required class="form-control">
                        </div>

                        <!-- Exam Type -->
                        <div class="col-md-3 mb-3">
                            <label for="exam_type">Exam Type</label>
                            <select name="exam_type" required class="form-control">
                                <option value="weekly" {{ $exam->exam_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ $exam->exam_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="terminal" {{ $exam->exam_type == 'terminal' ? 'selected' : '' }}>Terminal</option>
                                <option value="final" {{ $exam->exam_type == 'final' ? 'selected' : '' }}>Final</option>
                            </select>
                        </div>

                        <!-- Bibag Selection -->
                        <div class="col-md-3 mb-3">
                            <label for="bibag_id">Bibag</label>
                            <select name="bibag_id" id="bibag_id" class="form-control" required>
                                <option value="">Select Bibag</option>
                                @foreach($bibags as $bibag)
                                    <option value="{{ $bibag->id }}" {{ $bibag->id == $exam->bibag_id ? 'selected' : '' }}>{{ $bibag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Sreni and Subject Selection -->
                    <div id="class-subjects-wrapper">
                        @foreach($exam->srenis as $index => $sreni)
                        <div class="row class-row mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Classes</label>
                                <select name="srenis[]" class="form-control sreni-select" required>
                                    <option value="">Select Class</option>
                                    @foreach($srenis as $class)
                                        <option value="{{ $class->id }}" {{ $class->id == $sreni->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Subjects</label>
                                <div class="subjects-container">
                                    @foreach($classSubjects[$sreni->id] as $subject)
                                    <div class="subject-group mb-2">
                                        <select name="subjects[][subject_id]" class="form-control subject-select" required>
                                            <option value="">Select Subject</option>
                                            @foreach($subjects as $subjectOption)
                                                <option value="{{ $subjectOption->id }}" {{ $subjectOption->id == $subject->id ? 'selected' : '' }}>{{ $subjectOption->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="marks[]" value="{{ optional($exam->subjects->where('id', $subject->id)->first())->pivot->mark ?? '' }}" class="form-control mt-2 marks-input" placeholder="Marks" required>
                                        <button type="button" class="btn btn-danger btn-sm remove-subject mt-2">Remove</button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-success btn-sm add-subject">+ Add Subject</button>
                            </div>

                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-danger remove-class-row mt-4">- Remove Class</button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Add Class Row Button -->
                    <button type="button" class="btn btn-success" id="add-class-row">+ Add Class</button>

                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary">Update Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Reindex all class rows to ensure correct indexing
        function reindexClassRows() {
            const classRows = document.querySelectorAll('.class-row');
            classRows.forEach((row, rowIndex) => {
                const sreniSelect = row.querySelector('.sreni-select');
                sreniSelect.name = `srenis[]`;

                const subjectSelects = row.querySelectorAll('.subject-select');
                const marksInputs = row.querySelectorAll('.marks-input');
                subjectSelects.forEach((select) => {
                    select.name = `subjects[][subject_id]`;
                });
                marksInputs.forEach((input) => {
                    input.name = `marks[]`;
                });
            });
        }

        // Add new class row
        document.getElementById('add-class-row').addEventListener('click', function () {
            const newRow = document.createElement('div');
            newRow.className = 'row class-row mb-3';
            newRow.innerHTML = `
                <div class="col-md-3 mb-3">
                    <label>Classes</label>
                    <select name="srenis[]" class="form-control sreni-select" required>
                        <option value="">Select Class</option>
                        @foreach($srenis as $sreni)
                            <option value="{{ $sreni->id }}">{{ $sreni->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Subjects</label>
                    <div class="subjects-container">
                        <div class="subject-group mb-2">
                            <select name="subjects[][subject_id]" class="form-control subject-select" required>
                                <option value="">Select Subject</option>
                            </select>
                            <input type="number" name="marks[]" class="form-control mt-2 marks-input" placeholder="Marks" required>
                            <button type="button" class="btn btn-danger btn-sm remove-subject mt-2">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm add-subject">+ Add Subject</button>
                </div>
                <div class="col-md-3 mb-3">
                    <button type="button" class="btn btn-danger remove-class-row mt-4">- Remove Class</button>
                </div>
            `;

            document.getElementById('class-subjects-wrapper').appendChild(newRow);
            reindexClassRows();
        });

        // Handle Add Subject
        document.getElementById('class-subjects-wrapper').addEventListener('click', function (e) {
            if (e.target.classList.contains('add-subject')) {
                const container = e.target.closest('.col-md-6').querySelector('.subjects-container');
                const subjectGroup = document.createElement('div');
                subjectGroup.className = 'subject-group mb-2';
                subjectGroup.innerHTML = `
                    <select name="subjects[][subject_id]" class="form-control subject-select" required>
                        <option value="">Select Subject</option>
                    </select>
                    <input type="number" name="marks[]" class="form-control mt-2 marks-input" placeholder="Marks" required>
                    <button type="button" class="btn btn-danger btn-sm remove-subject mt-2">Remove</button>
                `;

                container.appendChild(subjectGroup);
                reindexClassRows();
            }

            // Remove subject
            if (e.target.classList.contains('remove-subject')) {
                e.target.closest('.subject-group').remove();
                reindexClassRows();
            }

            // Remove class row
            if (e.target.classList.contains('remove-class-row')) {
                e.target.closest('.class-row').remove();
                reindexClassRows();
            }
        });

        // Initial event listeners for existing sreni selects
        document.querySelectorAll('.sreni-select').forEach(select => {
            select.addEventListener('change', function () {
                fetchSubjects(this);
            });
        });

        // Fetch subjects based on selected sreni
        function fetchSubjects(sreniSelect) {
            const classRow = sreniSelect.closest('.class-row');
            const bibagId = document.getElementById('bibag_id').value;
            const sreniId = sreniSelect.value;

            classRow.querySelectorAll('.subject-select').forEach(select => {
                select.innerHTML = '<option value="">Select Subject</option>';
                if (bibagId && sreniId) {
                    fetch(`{{ route('filter.subjects') }}?bibag_id=${bibagId}&sreni_id=${sreniId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.subjects.forEach(subject => {
                                const option = document.createElement('option');
                                option.value = subject.id;
                                option.textContent = subject.name;
                                select.appendChild(option);
                            });
                        });
                }
            });
        }
    });
</script>
@endsection
