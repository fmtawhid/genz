@extends('layouts.admin_master')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Add New Exam</h4>
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
                <form action="{{ route('exams.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Exam Name -->
                        <div class="col-md-3 mb-3">
                            <label for="name">Exam Name</label>
                            <input type="text" name="name" required class="form-control">
                        </div>

                        <!-- Exam Date -->
                        <div class="col-md-3 mb-3">
                            <label for="date">Exam Date</label>
                            <input type="date" name="date" required class="form-control">
                        </div>

                        <!-- Exam Type -->
                        <div class="col-md-3 mb-3">
                            <label for="exam_type">Exam Type</label>
                            <select name="exam_type" required class="form-control">
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="terminal">Terminal</option>
                                <option value="final">Final</option>
                            </select>
                        </div>

                        <!-- Bibag Selection -->
                        <div class="col-md-3 mb-3">
                            <label for="bibag_id">Bibag</label>
                            <select name="bibag_id" id="bibag_id" class="form-control" required>
                                <option value="">Select Bibag</option>
                                @foreach($bibags as $bibag)
                                    <option value="{{ $bibag->id }}">{{ $bibag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Sreni and Subject Selection -->
                    <div id="class-subjects-wrapper">

                        <!-- First Sreni Row -->
                        <div class="row class-row mb-3">
                            <!-- Sreni -->
                            <div class="col-md-3 mb-3">
                                <label>Classes</label>
                                <select name="srenis[]" class="form-control sreni-select" required>
                                    <option value="">Select Class</option>
                                    @foreach($srenis as $sreni)
                                        <option value="{{ $sreni->id }}">{{ $sreni->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subject -->
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

                            <!-- Remove Class Button -->
                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-danger remove-class-row mt-4">- Remove Class</button>
                            </div>
                        </div>

                    </div>

                    <!-- Add Class Row Button -->
                    <button type="button" class="btn btn-success" id="add-class-row">+ Add Class</button>

                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary">Create Exam</button>
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
                // Update sreni select name
                const sreniSelect = row.querySelector('.sreni-select');
                sreniSelect.name = `srenis[]`;

                // Update subject selects and marks inputs
                const subjectSelects = row.querySelectorAll('.subject-select');
                const marksInputs = row.querySelectorAll('.marks-input');
                subjectSelects.forEach((select) => {
                    select.name = `subjects[][subject_id]`; // Removed indexing
                });
                marksInputs.forEach((input) => {
                    input.name = `marks[]`; // Removed indexing
                });
            });
        }

        // Fetch subjects based on selected bibag and sreni
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

            // Attach event listeners for the new row
            newRow.querySelector('.sreni-select').addEventListener('change', function () {
                fetchSubjects(this);
            });

            reindexClassRows();
        });

        // Handle bibag change to update all subjects
        document.getElementById('bibag_id').addEventListener('change', function () {
            document.querySelectorAll('.sreni-select').forEach(sreniSelect => {
                if (sreniSelect.value) {
                    fetchSubjects(sreniSelect);
                }
            });
        });

        // Delegated event listeners for dynamic elements
        document.getElementById('class-subjects-wrapper').addEventListener('click', function (e) {
            // Add subject
            if (e.target.classList.contains('add-subject')) {
                const container = e.target.closest('.col-md-6').querySelector('.subjects-container');
                const classRow = e.target.closest('.class-row');

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

                // Fetch subjects if sreni and bibag are selected
                const sreniSelect = classRow.querySelector('.sreni-select');
                if (sreniSelect.value && document.getElementById('bibag_id').value) {
                    fetchSubjects(sreniSelect);
                }
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
    });
</script>
@endsection
