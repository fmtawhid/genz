@extends('layouts.admin_master')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Students</h4>
                <ol class="breadcrumb m-0">
                    <li class="me-3">
                        <div class="d-flex justify-content-end align-items-center">
                            <!-- Export Buttons -->
                            <a href="#" id="export_excel" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                            <a href="#" id="export_pdf" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                        </div>
                    </li>
                    @can('student_add')
                    <li class="breadcrumb-item"><a href="{{ route('students.create') }}" class="btn btn-primary"><i
                                class="ri-add-circle-line"></i> Make Admission</a></li>
                    @endcan
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Data Tables</li> --}}
                </ol>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("export_excel").classList.add("disabled");
            document.getElementById("export_pdf").classList.add("disabled");

            document.getElementById("filter").addEventListener("click", function() {
                document.getElementById("export_excel").classList.remove("disabled");
                document.getElementById("export_pdf").classList.remove("disabled");
            });

            document.getElementById("reset").addEventListener("click", function() {
                document.getElementById("export_excel").classList.add("disabled");
                document.getElementById("export_pdf").classList.add("disabled");
            });
        });
    </script>

    <!-- Date Filters -->
    <div class="row my-3">
        <div class="col-md-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="text" id="from_date" class="form-control" placeholder="dd-mm-yy">
        </div>
        <div class="col-md-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="text" id="to_date" class="form-control" placeholder="dd-mm-yy">
        </div>
        <div class="col-md-2">
            <label for="class_id" class="form-label">Bibhag</label>
            <select class="form-control select2" id="bibag_id" name="bibag_id" style="width: 100%;" required>
                <option selected="selected" value="">Select Bibhag</option>
                @foreach ($bibags as $bibag)
                    <option {{ $bibag->id == old('bibag_id') ? 'selected' : '' }} value="{{ $bibag->id }}">
                        {{ $bibag->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="col-md-2 align-self-end">
            <button id="filter" class="btn btn-success me-2">Filter</button>
            <button id="reset" class="btn btn-secondary me-2">Reset</button>
        </div>
    </div>
    <!-- End Date Filters -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="product" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Form Number</th>
                                <th>User ID</th>
                                <th>Student Registration Date</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Mobile</th>
                                <th>Bibhag</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->



    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModal" tabindex="-1" aria-labelledby="attachmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="attachmentsGallery" class="row">
                        <!-- Attachments will be loaded here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#to_date").flatpickr({
            dateFormat: "d-m-Y"
        })

        $("#from_date").flatpickr({
            dateFormat: "d-m-Y"
        })
    </script>


    <script>
        $(document).ready(function() {
            // Define the route template with a placeholder for student ID
            var attachmentsRouteTemplate = "{{ route('students.attachments', ':id') }}";

            // Initialize DataTable
            var table = $("#product").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                dom: 'Bfrtip', // Add this to enable buttons
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Export Excel',
                        titleAttr: 'Export Excel',
                        exportOptions: {
                            columns: ':visible:not(:last-child)' // Exclude Actions column
                        },
                        action: function(e, dt, button, config) {
                            // Custom action to include filters
                            var fromDate = $('#from_date').val();
                            var toDate = $('#to_date').val();
                            var bibagId = $('#bibag_id').val();
                            window.location.href = "{{ route('students.export.excel') }}" +
                                "?from_date=" + fromDate + "&to_date=" + toDate + "&bibag_id=" +
                                bibagId;
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> Export PDF',
                        titleAttr: 'Export PDF',
                        exportOptions: {
                            columns: ':visible:not(:last-child)' // Exclude Actions column
                        },
                        action: function(e, dt, button, config) {
                            var fromDate = $('#from_date').val();
                            var toDate = $('#to_date').val();
                            var bibagId = $('#bibag_id').val();
                            window.location.href = "{{ route('students.export.pdf') }}" +
                                "?from_date=" + fromDate + "&to_date=" + toDate + "&bibag_id=" +
                                bibagId;
                        }
                    }
                ],
                ajax: {
                    url: "{{ route('students.index') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.bibag_id = $('#bibag_id').val();
                    }
                },
                
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "form_number",
                        name: "form_number",
                        searchable: false
                    },
                    {
                        data: "dhakila_number",
                        name: "dhakila_number",
                        searchable: true
                    }, // Only this column is searchable
                    {
                        data: "dhakila_date",
                        name: "dhakila_date",
                        searchable: false
                    },
                    {
                        data: "student_name",
                        name: "student_name",
                        searchable: false
                    },
                    {
                        data: "father_name",
                        name: "father_name",
                        searchable: false
                    },
                    {
                        data: "mobile",
                        name: "mobile",
                        searchable: false
                    },
                    {
                        data: "bibag_name",
                        name: "bibag_name",
                        searchable: false
                    },
                   
                    {
                        data: "created_at_read",
                        name: "created_at_read",
                        searchable: false
                    },
                    {
                        data: "actions",
                        name: "actions",
                        orderable: false,
                        searchable: false
                    },
                ],

                initComplete: function(settings, json) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    // Handle Delete Button Clicks
                    $(document).on("click", ".delete", function(e) {
                        e.preventDefault();
                        let that = $(this);
                        $.confirm({
                            icon: "fas fa-exclamation-triangle",
                            closeIcon: true,
                            title: "Are you sure?",
                            content: "You cannot undo this action!",
                            type: "red",
                            typeAnimated: true,
                            buttons: {
                                confirm: function() {
                                    that.closest("form").submit();
                                },
                                cancel: function() {
                                    // Do nothing
                                },
                            },
                        });
                    });

                    // Handle View Attachments Button Click
                    $(document).on('click', '.view-attachments', function() {
                        let studentId = $(this).data('id');

                        // Generate the actual route by replacing the placeholder with the student ID
                        let attachmentsRoute = attachmentsRouteTemplate.replace(':id',
                            studentId);

                        // Clear previous attachments
                        $('#attachmentsGallery').empty();

                        // Fetch attachments via AJAX
                        $.ajax({
                            url: attachmentsRoute,
                            type: 'GET',
                            success: function(response) {
                                if (response.attachments.length > 0) {
                                    response.attachments.forEach(function(
                                        attachment) {
                                        if (['jpg', 'jpeg', 'png', 'gif',
                                                'svg'
                                            ].includes(attachment.file_type
                                                .toLowerCase())) {
                                            // Display image using Lightbox
                                            $('#attachmentsGallery').append(`
                                                <div class="col-md-3 mb-3">
                                                    <a href="${attachment.url}" data-lightbox="attachments" data-title="${attachment.name}">
                                                        <img src="${attachment.url}" alt="${attachment.name}" class="img-fluid img-thumbnail">
                                                    </a>
                                                </div>
                                            `);
                                        } else if (['pdf'].includes(
                                                attachment.file_type
                                                .toLowerCase())) {
                                            // Display PDF icon with link to view/download
                                            $('#attachmentsGallery').append(`
                                                <div class="col-md-3 mb-3 text-center">
                                                    <a href="${attachment.url}" target="_blank" data-title="${attachment.name}">
                                                        <i class="fa fa-file-pdf-o fa-5x text-danger"></i>
                                                        <p>${attachment.name}</p>
                                                    </a>
                                                      <a href="${attachment.url}" download class="btn btn-sm btn-outline-primary mt-2">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                                </div>
                                            `);
                                        } else {
                                            // Handle other file types if necessary
                                        }
                                    });
                                } else {
                                    $('#attachmentsGallery').append(`
                                        <div class="col-12">
                                            <p class="text-center">No attachments found for this student.</p>
                                        </div>
                                    `);
                                }

                                // Show the modal
                                $('#attachmentsModal').modal('show');
                            },
                            error: function(xhr) {
                                toastr.error('Failed to fetch attachments.');
                            }
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ajax error: ", textStatus, errorThrown);
                },
            });


            // Filter button click
            $('#filter').click(function() {
                table.draw();
            });

            // Reset button click
            $('#reset').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#bibag_id').val('');
                table.draw();
            });

            // Export Excel
            $('#export_excel').click(function(e) {
                e.preventDefault();
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                let bibagId = $('#bibag_id').val();
                let url = "{{ route('students.export.excel') }}" + "?from_date=" + fromDate + "&to_date=" +
                    toDate + "&bibag_id=" + bibagId;
                window.location.href = url;
            });

            // Export PDF
            $('#export_pdf').click(function(e) {
                e.preventDefault();
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                let bibagId = $('#bibag_id').val();
                let url = "{{ route('students.export.pdf') }}" + "?from_date=" + fromDate + "&to_date=" +
                    toDate + "&bibag_id=" + bibagId;
                window.location.href = url;
            });
        });
    </script>
@endsection
