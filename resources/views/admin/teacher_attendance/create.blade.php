@extends('layouts.admin_master')

@section('content')
<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Teacher Attendance</h4>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Flash Messages -->
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Attendance Form -->
<form id="teacherAttendanceForm" method="POST" action="{{ route('teacher.attendance.store') }}">

    <!-- Date Filter -->
    <div class="row my-3">
        <div class="col-md-3">
            <label for="filter_date" class="form-label">Date</label>
            <input type="text" id="filter_date" class="form-control" name="date" placeholder="dd-mm-yyyy" required>
        </div>

        <div class="col-md-2 align-self-end">
            <button type="button" id="filter" class="btn btn-success">Filter</button>
        </div>
    </div>

    @csrf
    <input type="hidden" id="hidden_date" name="date">

    <!-- Teacher Attendance Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Teacher Name</th>
                    <th>Designation</th>
                    @foreach ($attendanceTypes as $type)
                    <th class="">
                        <input type="checkbox" name="{{ $type->id }}" class="select-all-radio"
                            data-type-id="{{ $type->id }}" style="height:18px; width:18px;">
                        <label for="selectAll">{{ $type->name }}</label>
                    </th>
                    @endforeach
                    <th>Note (optional)</th>
                </tr>
            </thead>
            <tbody id="attendanceBody"></tbody>
        </table>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save Attendance</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Date Picker
    $("#filter_date").flatpickr({
        dateFormat: "d-m-Y"
    });

    // Filter Button Click
    $("#filter").click(function() {
        const date = $("#filter_date").val();

        if (!date) {
            alert("Please select a date before filtering.");
            return;
        }

        // Update hidden input with the selected date
        $("#hidden_date").val(date);

        // Fetch teachers via AJAX
        $.ajax({
            url: "{{ route('teacher.attendance.filter') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                date: date,
            },
            success: function(response) {
                if (response.length === 0) {
                    alert("No teachers found for the selected date.");
                    return;
                }

                let rows = "";
                response.forEach((teacher, index) => {
                    const attendanceTypes = @json($attendanceTypes);
                    let attendanceOptions = "";
                    attendanceTypes.forEach((type) => {
                        attendanceOptions += `
                        <td>
                                
                                <style>
                                .custom-radio {
                                    display: none; /* Hide the default radio button */
                                }

                                .custom-radio + label {
                                    display: inline-block;
                                    width: 26px;
                                    height: 26px;
                                    border: 2px solid #ccc;
                                    border-radius: 50%;
                                    cursor: pointer;
                                    position: relative;
                                    transition: all 0.3s ease;
                                }

                                .custom-radio:checked + label {
                                    background-color: #4CAF50;
                                    border-color: #4CAF50;
                                }

                                .custom-radio:checked + label::after {
                                    content: "✔";
                                    color: white;
                                    font-size: 12px;
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                }
                                </style>

                                <!-- Radio Button -->
                                <input 
                                type="radio" 
                                id="attendance-${teacher.id}-${type.id}" 
                                class="custom-radio attendance-radio-${type.id}" 
                                name="attendance[${teacher.id}]" 
                                value="${type.id}" 
                                required
                                >
                                <label for="attendance-${teacher.id}-${type.id}"></label>

                            </td>
                            
                        `;
                    });

                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${teacher.name}</td>
                            <td>${teacher.designation}</td>
                            ${attendanceOptions}
                            <td>
                                <input type="text" name="remark[${teacher.id}]" class="form-control" placeholder="Add note (optional)">
                            </td>
                        </tr>`;
                });

                $("#attendanceBody").html(rows);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert("Failed to fetch teachers. Please try again.");
            },
        });
    });

    // "Select All" Radio Button Logic
    $(document).on("change", ".select-all-radio", function() {
        const typeId = $(this).data('type-id');
        const isChecked = $(this).is(":checked");

        // Check or uncheck all radio buttons for the specific attendance type
        $(`.attendance-radio-${typeId}`).each(function() {
            $(this).prop("checked", isChecked);
        });
    });
});
</script>
@endsection