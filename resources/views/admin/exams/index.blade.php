@extends('layouts.admin_master')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Add New Exam</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('exams.create') }}" class="btn btn-primary">Exam Create</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <table class="table table-bordered" id="examTable">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Exam Name</th>
                <th>Exam Date</th>
                <th>Exam Type</th>
                <th>Bibag</th>
                <th>Classes</th>
                <th>Subjects</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#examTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('exams.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'date', name: 'date' },
                    { data: 'exam_type', name: 'exam_type' },
                    { data: 'bibag', name: 'bibag' },
                    { data: 'srenis', name: 'srenis' },
                    { data: 'subjects', name: 'subjects' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection