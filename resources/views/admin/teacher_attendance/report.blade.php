@extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Teacher Attendance Report</h4>
                <ol class="breadcrumb m-0">
                    <li class="me-3">
                        <div class="d-flex justify-content-end align-items-center">
                            <!-- Export Buttons -->
                            <a href="#" class="btn btn-success me-2" id="export_excel">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                            <a href="javascript:void(0);" id="export_pdf" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                        </div>
                    </li>
                    @can('teacher_attendance_add')
                    <li class="breadcrumb-item"><a href="{{ route('attendances.index') }}" class="btn btn-primary"><i
                                class="ri-add-circle-line"></i> Add Attendance</a></li>
                    @endcan
                </ol>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Disable export buttons on page load
            document.getElementById("export_excel").classList.add("disabled");
            document.getElementById("export_pdf").classList.add("disabled");

            // Enable export buttons when filter is applied
            document.getElementById("filter_btn").addEventListener("click", function() {
                document.getElementById("export_excel").classList.remove("disabled");
                document.getElementById("export_pdf").classList.remove("disabled");
            });

            // Disable export buttons when reset is clicked
            document.getElementById("reset_btn").addEventListener("click", function() {
                document.getElementById("export_excel").classList.add("disabled");
                document.getElementById("export_pdf").classList.add("disabled");
            });
        });
    </script>
    <!-- End Page Title -->

    <!-- Filter Form -->
    <form id="filter_form" class="my-3">
        <div class="row">
            <div class="col-md-3">
                <label for="filter_date" class="form-label">Date</label>
                <input type="text" id="filter_date" class="form-control" name="date" placeholder="dd-mm-yyyy">
            </div>
            <div class="col-md-3 align-self-end">
                <button type="button" id="filter_btn" class="btn btn-success">Filter</button>
                <button type="button" id="reset_btn" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>

    <!-- Report Table -->
    <div class="table-responsive">
        <table id="attendance_table" class="table table-striped">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Date</th>
                    <th>Teacher Name</th>
                    <th>Designation</th>
                    <th>Attendance Type</th>
                    <th>Remark</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Date Picker
            $("#filter_date").flatpickr({
                dateFormat: "d-m-Y"
            });

            // Initialize DataTable
            let table = $('#attendance_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('teacher.attendance.report') }}",
                    data: function(d) {
                        d.date = $('#filter_date').val();
                        d.teacher_name = $('#teacher_name').val(); // Pass teacher name filter
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "date",
                        name: "date"
                    },
                    {
                        data: "teacher_name",
                        name: "teacher.name"
                    },
                    {
                        data: "designation",
                        name: "teacher.designation"
                    },
                    {
                        data: "attendance_type",
                        name: "attendanceType.name",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "remark",
                        name: "remark"
                    }
                ]
            });

            // Handle Filter Button Click
            $('#filter_btn').on('click', function() {
                table.ajax.reload();
            });

            // Handle Reset Button Click
            $('#reset_btn').on('click', function() {
                $('#filter_form')[0].reset();
                table.ajax.reload();
            });

            $('#export_pdf').click(function(e) {
                e.preventDefault();
                let filter_date = $('#filter_date').val();
                let url = "{{ route('TeacherAttendance.PDF.export') }}?filter_date=" + encodeURIComponent(
                    filter_date || "");
                window.location.href = url;
            });

            $('#export_excel').click(function(e) {
                e.preventDefault();
                let filter_date = $('#filter_date').val();
                let url = "{{ route('TeacherAttendance.Excel.export') }}?filter_date=" + encodeURIComponent(
                    filter_date || "");
                window.location.href = url;
            });


        });
    </script>
@endsection
