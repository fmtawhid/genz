@extends('layouts.admin_master')

@section('content')
    <!-- Create Payment Form and Payments List -->
    <div class="row mt-3">
        <!-- Create Payment Form -->
        @can('payment_add')
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4 class="page-title">Add Payment</h4>
                        </div>
                    </div>
                    <form id="createPaymentForm" action="{{ route('payments.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <!-- Purpose -->
                            <div class="mb-3 col-md-12">
                                <label for="purpose_id" class="form-label">Purpose <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="purpose_id" name="purpose_id" style="width: 100%;"
                                    required>
                                    <option value="">Select Purpose</option>
                                    @foreach ($purposes as $purpose)
                                        <option value="{{ $purpose->id }}"
                                            {{ old('purpose_id') == $purpose->id ? 'selected' : '0' }}>
                                            {{ $purpose->purpose_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('purpose_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Receipt No -->
                            <div class="mb-3 col-md-12">
                                <label for="reciept_no" class="form-label">Receipt No <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="reciept_no" name="reciept_no"
                                    value="{{ old('reciept_no') }}" placeholder="Enter Receipt Number" required>
                                @error('reciept_no')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="mb-3 col-md-12">
                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="date" name="date"
                                    placeholder="dd-mm-yy" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- User ID -->
                            <div class="mb-3 col-md-12">
                                <label for="dhakila_number" class="form-label">User ID <span
                                        class="text-danger"></span></label>
                                <input type="number" class="form-control" id="dhakila_number" name="dhakila_number"
                                    value="{{ old('dhakila_number') }}" placeholder="Enter Dhakhila Number">
                                @error('dhakila_number')
                                    <div class="text-danger my-2">{{ $message }}</div>

                                @enderror
                            </div>

                            <!-- Amount -->
                            <div class="mb-3 col-md-12">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    value="{{ old('amount') }}" placeholder="Enter Amount" required>
                                @error('amount')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount in Words -->
                            <div class="mb-3 col-md-12">
                                <label for="amount_in_words" class="form-label">Amount in Words <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="amount_in_words" name="amount_in_words"
                                    value="{{ old('amount_in_words') }}" placeholder="Amount in Words" required>
                                @error('amount_in_words')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Name -->
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Enter Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Address -->
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Present address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address') }}" placeholder="Enter Address" required>
                                @error('address')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="bibag_id" class="form-label">Bibhag <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="bibag_id" name="bibag_id" style="width: 100%;"
                                    required>
                                    <option value="">Select Bibhag</option>
                                    @foreach ($bibags as $bibag)
                                        <option value="{{ $bibag->id }}"
                                            {{ old('bibag_id') == $bibag->id ? 'selected' : '' }}>
                                            {{ $bibag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bibag_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Class (Sreni) -->
                            <div class="mb-3 col-md-12">
                                <label for="sreni_id" class="form-label">Class <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="sreni_id" name="sreni_id" style="width: 100%;"
                                    required>
                                    <option value="">Select Class</option>
                                    @foreach ($srenis as $sreni)
                                        <option value="{{ $sreni->id }}"
                                            {{ old('sreni_id') == $sreni->id ? 'selected' : '' }}>
                                            {{ $sreni->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sreni_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="mobile" class="form-label">Send Payment SMS <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    value="{{ old('mobile') }}" placeholder="Enter mobile" required>
                                @error('mobile')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Attachments Section -->
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <button type="button" class="btn btn-primary upload-btn" data-bs-toggle="modal"
                                        data-bs-target="#attachmentsModal">
                                        <i class="fas fa-upload"></i> Upload Attachments
                                    </button>
                                    <div id="attachmentsPreview" class="mt-3 d-flex flex-wrap gap-3">
                                        <!-- Image and PDF previews will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" id="submit" class="btn btn-success">Submit Payment</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
        @endcan

        @can('payment_view')
        <!-- Payments DataTable -->
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table id="paymentsTable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Receipt No</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>User ID</th>
                                <th>Present address</th>
                                <th>Purpose</th>
                                <th>Amount</th>
                                <th>Amount in Words</th>
                                <th>Class</th>
                                <th>Bibhag</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via DataTables AJAX -->
                        </tbody>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
        @endcan
    </div> <!-- end row -->
    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModal" tabindex="-1" aria-labelledby="attachmentsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropzone Form -->
                    <form action="#" class="dropzone" id="attachmentsDropzone">
                        @csrf
                        <div class="dz-message">
                            Drag and drop files here or click to upload.<br>
                            <span class="note">(Only images and PDFs, max size 512KB each)</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveAttachments">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModalGal" tabindex="-1" aria-labelledby="attachmentsModalGalLabel"
        aria-hidden="true">
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
        $("#date").flatpickr({
            dateFormat: "d-m-Y"
        })
    </script>
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            // Initialize Select2 for dropdowns
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
            // Initialize Dropzone
            var selectedFiles = []; // Array to hold selected files

            var dropzone = new Dropzone("#attachmentsDropzone", {
                url: "#", // No upload URL since we'll handle files on form submission
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 10,
                maxFilesize: 0.5, // MB
                acceptedFiles: 'image/*,.pdf',
                addRemoveLinks: true,
                dictDefaultMessage: "Drag and drop files here or click to upload.",
                init: function() {
                    var dz = this;

                    // Handle file added
                    dz.on("addedfile", function(file) {
                        // Limit number of files if needed
                        if (selectedFiles.length >= 10) { // Example limit
                            dz.removeFile(file);
                            toastr.warning('Maximum 10 files are allowed.');
                        } else {
                            selectedFiles.push(file);
                        }
                    });

                    // Handle file removed
                    dz.on("removedfile", function(file) {
                        var index = selectedFiles.indexOf(file);
                        if (index > -1) {
                            selectedFiles.splice(index, 1);
                        }
                    });
                }
            });


            $('#saveAttachments').click(function() {
                // Clear previous previews for new attachments
                // (existing attachments are handled separately)
                // $('#attachmentsPreview').empty(); // Don't clear existing attachments

                // Append selected files to the main form
                selectedFiles.forEach(function(file, index) {
                    // Check if the file is PDF or image and append the corresponding preview
                    if (file.type === "application/pdf") {
                        // Display PDF icon with file name and remove button
                        $('#attachmentsPreview').append(`
                            <div class="position-relative attachment-container m-2">
                                <a href="#" target="_blank" data-title="${file.name}">
                                    <i class="fa fa-file-pdf-o fa-5x text-danger attachment-icon"></i>
                                </a>
                                <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">
                                    &times;
                                </button>
                                <input type="hidden" name="attachments[]" value="${file.name}">
                            </div>
                        `);
                    } else if (file.type.startsWith("image/")) {
                        // Create a FileReader to generate image previews
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#attachmentsPreview').append(`
                                <div class="position-relative attachment-container m-2">
                                    <a href="${e.target.result}" data-lightbox="attachments" data-title="${file.name}">
                                        <img src="${e.target.result}" alt="${file.name}" class="img-thumbnail attachment-image">
                                    </a>
                                    <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                    <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">
                                        &times;
                                    </button>
                                    <input type="hidden" name="attachments[]" value="${file.name}">
                                </div>
                            `);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Handle other file types if necessary
                        $('#attachmentsPreview').append(`
                            <div class="position-relative attachment-container m-2">
                                <a href="#" target="_blank" data-title="${file.name}">
                                    <i class="fas fa-file fa-5x text-secondary attachment-icon"></i>
                                </a>
                                <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">
                                    &times;
                                </button>
                                <input type="hidden" name="attachments[]" value="${file.name}">
                            </div>
                        `);
                    }
                });

                // Close the modal
                $('#attachmentsModal').modal('hide');
            });

            // Handle removal of previewed attachments
            $(document).on('click', '.remove-preview', function() {
                var index = $(this).data('index');
                // Remove from selectedFiles array
                selectedFiles.splice(index, 1);
                // Remove the preview
                $(this).parent().remove();
            });

            // Handle form submission
            $('#createPaymentForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Create FormData object
                var formData = new FormData(this);

                // Append selected files
                selectedFiles.forEach(function(file, index) {
                    formData.append('attachments[]', file);
                });

                // Disable the submit button to prevent multiple submissions
                $('#submit').prop('disabled', true).text('Submitting...');

                // Send the form data via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false, // Important
                    contentType: false, // Important
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                            // Optionally, redirect or reset the form
                            window.location.href = "{{ route('payments.index') }}";
                        } else {
                            toastr.error('An error occurred while submitting the form.');
                            $('#submit').prop('disabled', false).text('Submit');
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, messages) {
                                toastr.error(messages[0]); // 5000ms = 5 seconds
                            });
                        } else {
                            toastr.error('An unexpected error occurred.');
                        }
                        $('#submit').prop('disabled', false).text('Submit');
                    }
                });
            });
            var attachmentsRouteTemplate = "{{ route('payments.attachments', ':id') }}";
            // Initialize DataTable for Payments
            $('#paymentsTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('payments.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'reciept_no',
                        name: 'reciept_no'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'dhakila_number',
                        name: 'dhakila_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'purpose',
                        name: 'purpose'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'amount_in_words',
                        name: 'amount_in_words'
                    },
                    {
                        data: 'sreni',
                        name: 'sreni'
                    },
                    {
                        data: 'bibag',
                        name: 'bibag'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
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
                                $('#attachmentsModalGal').modal('show');
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


        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dhakila_number').on('change', function() {
                var dhakilaNumber = $(this).val();

                if (dhakilaNumber) {
                    $.ajax({
                        url: '{{ url('panel/get-student-details') }}/' +
                        dhakilaNumber, // This will use the full base URL
                        type: 'GET',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                            } else {
                                $('#name').val(response.student_name);
                                $('#address').val(response.district);
                                $('#bibag_id').val(response.bibag_id).trigger('change');
                                $('#sreni_id').val(response.sreni_id).trigger('change');
                                $('#mobile').val(response.mobile).trigger('change');
                            }
                        },
                        error: function() {
                            alert('An error occurred while fetching the student details.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
