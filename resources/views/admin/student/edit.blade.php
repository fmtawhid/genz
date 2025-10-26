@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Add Student For Admission</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('students.index') }}" class="btn btn-primary"> Admission Student List </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="createStudentForm" action="{{ route('students.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Form Number -->
                            <div class="mb-3 col-md-4">
                                <label for="form_number" class="form-label">Form Number </label>
                                <input class="form-control" name="form_number" value="{{ old('form_number', $student->form_number) }}"
                                    type="text" id="form_number" placeholder="Enter Form Number">
                                @error('form_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- User ID -->
                            <div class="mb-3 col-md-4">
                                <label for="dhakila_number" class="form-label">User ID <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="dhakila_number" value="{{ old('dhakila_number', $student->dhakila_number) }}"
                                    type="text" id="dhakila_number" placeholder="Enter User ID" required>
                                @error('dhakila_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Student Registration Date -->
                            <div class="mb-3 col-md-4">
                                <label for="dhakila_date" class="form-label">Student Registration Date  </label>
                                        <input class="form-control" name="dhakila_date" value="{{ old('dhakila_date', $student->dhakila_date) }}"
                                        type="text" id="dhakila_date" placeholder="d-m-Y">

                                @error('dhakila_date')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <!-- Student Name -->
                            <div class="mb-3 col-md-4">
                                <label for="student_name" class="form-label">Student Name  </label>
                                <input class="form-control" name="student_name" value="{{ old('student_name', $student->student_name) }}"
                                    type="text" id="student_name" placeholder="Enter Student Name" required>
                                @error('student_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror 
                            </div>

                            <!-- Father Name -->
                            <div class="mb-3 col-md-4">
                                <label for="father_name" class="form-label">Father Name  </label>
                                <input class="form-control" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                                    type="text" id="father_name" placeholder="Enter Father Name" required>
                                @error('father_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="mobile" class="form-label">Father's Mobile </label>
                                <input class="form-control" name="mobile" value="{{ old('mobile', $student->mobile) }}" type="text"
                                    id="mobile" placeholder="Enter Mobile Number" required>
                                @error('mobile')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Mobile -->
                            
                            <div class="mb-3 col-md-6">
                                <label for="mother_name" class="form-label">Mother Name </label>
                                <input class="form-control" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}" type="text"
                                    id="mother_name" placeholder="Enter Mother Number">
                                @error('mother_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="mother_phone" class="form-label">Mother Phone Number </label>
                                <input class="form-control" name="mother_phone" value="{{ old('mother_phone', $student->mother_phone) }}" type="text"
                                    id="mother_phone" placeholder="Enter Mother Number">
                                @error('mother_phone')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="bibag_id" class="form-label">Bibhag  </label>
                                <select class="form-control select2" id="bibag_id" name="bibag_id" style="width: 100%;">
                                    <option value="">Select Bibhag</option>
                                    @foreach ($bibags as $bibag)
                                        <option value="{{ $bibag->id }}" {{ $bibag->id == old('bibag_id', $student->bibag_id) ? 'selected' : '' }}>
                                            {{ $bibag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bibag_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Address -->
                            <div class="mb-3 col-md-4">
                                <label for="address" class="form-label">Present address</label>
                                <input class="form-control" name="address" value="{{ old('address', $student->district) }}" type="text" id="address" placeholder="Enter Present address" required>
                                @error('address')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Type -->
                            <div class="mb-3 col-md-4">
                                <label for="type" class="form-label">Type  </label>
                                <select class="form-control" name="type" id="type" required>
                                    {{-- <option value="">Select Type</option> --}}
                                    <option value="Active" {{ old('type', $student->type) == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Deactive" {{ old('type', $student->type) == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                                </select>
                                @error('type')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row">
                            <!-- Academic Session -->
                            <div class="mb-3 col-md-6">
                                <label for="academic_session" class="form-label">Academic Session  </label>
                                <input class="form-control" name="academic_session"
                                    value="{{ old('academic_session', $student->academic_session) }}" type="text" id="academic_session"
                                    placeholder="e.g., 2023-2024" required>
                                @error('academic_session')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="sreni_id" class="form-label">Class  </label>
                                <select class="form-control select2" id="sreni_id" name="sreni_id" style="width: 100%;"
                                    >
                                    <option selected="selected" value="">Select Class</option>
                                    @foreach ($srenis as $sreni)
                                        <option {{ $sreni->id == old('sreni_id', $student->sreni_id) ? 'selected' : '' }}
                                            value="{{ $sreni->id }}">
                                            {{ $sreni->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sreni_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Gender -->
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Roll Number -->
                            <div class="mb-3 col-md-6">
                                <label for="roll_number" class="form-label">Roll Number  </label>
                                <input type="number" class="form-control" name="roll_number"
                                    value="{{ old('roll_number', $student->roll_number) }}" placeholder="Enter Roll Number" id="roll_number">
                                                              
                                @error('roll_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>                            
                        </div>
 
                        <div class="row">
                            <!-- Date of Birth -->
                            <div class="mb-3 col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input class="form-control" name="date_of_birth" type="date" id="date_of_birth"
                                    value="{{ old('date_of_birth', $student->date_of_birth) }}">
                                @error('date_of_birth')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" name="email" type="email" id="email"
                                    value="{{ old('email', $student->email) }}" placeholder="Enter email address">
                                @error('email')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Whatsapp Number -->
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="emergency_contact" class="form-label">Whatsapp Number </label>
                                <input class="form-control" name="emergency_contact" type="text"
                                    id="emergency_contact" value="{{ old('emergency_contact', $student->emergency_contact) }}"
                                    placeholder="Enter Whatsapp Number">
                                @error('emergency_contact')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="section_id" class="form-label">Section</label>
                                <select class="form-control select2" id="section_id" name="section_id">
                                    <option value="">Select Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id', $student->section_id ?? '') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Select Services -->
                            <div class="mb-3 col-md-12">
                                <label>Select Services</label>
                                <div>
                                    @foreach($optionalServices as $service)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}"
                                                id="service_{{ $service->id }}"
                                                {{ in_array($service->id, json_decode($student->services) ?: []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="service_{{ $service->id }}">
                                                {{ $service->service_type }} ({{ $service->amount }})
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image Upload -->
                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Profile Image</label>
                                <input class="form-control" name="image" type="file" id="image" accept="image/*">
                                @error('image')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
 
                        <!-- Attachments Section -->
                        <div class="mb-3 col-md-12">
                            <button type="button" class="btn btn-primary upload-btn" data-bs-toggle="modal"
                                data-bs-target="#attachmentsModal">
                                <i class="fas fa-upload"></i> Upload Attachments
                            </button>
                            <div id="attachmentsPreview" class="mt-3 d-flex flex-wrap gap-3">
                                @foreach ($student->attachments as $attachment)
                                    <div class="existing-attachment position-relative" data-id="{{ $attachment->id }}">
                                        @if (in_array(strtolower($attachment->file_type), ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                            <a href="{{ asset('assets/attachements/' . $attachment->file_path) }}" data-lightbox="attachment-{{ $attachment->id }}" data-title="{{ $attachment->file_name }}">
                                                <img src="{{ asset('assets/attachements/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="img-thumbnail attachment-image">
                                            </a>
                                        @elseif (strtolower($attachment->file_type) === 'pdf')
                                            <a href="{{ asset('assets/attachements/' . $attachment->file_path) }}" target="_blank" data-title="{{ $attachment->file_name }}">
                                                <i class="fa fa-file-pdf-o fa-5x text-danger attachment-icon"></i>
                                            </a>
                                        @else
                                            <a href="{{ asset('assets/attachements/' . $attachment->file_path) }}" target="_blank" data-title="{{ $attachment->file_name }}">
                                                <i class="fas fa-file fa-5x text-secondary attachment-icon"></i>
                                            </a>
                                        @endif
                                        <span class="d-block mt-2 text-center attachment-name">{{ $attachment->file_name }}</span>
                                        <button type="button" class="btn btn-danger btn-sm remove-existing-attachment" data-id="{{ $attachment->id }}">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
    <!-- End row -->

    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModal" tabindex="-1" aria-labelledby="attachmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropzone Form for attachments -->
                    <form action="#" class="dropzone" id="attachmentsDropzone" enctype="multipart/form-data">
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

@endsection

@section('scripts')
    <script>
        $("#dhakila_date").flatpickr({
            dateFormat: "d-m-Y"
        });

        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            var selectedFiles = [];

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

                    dz.on("addedfile", function(file) {
                        if (selectedFiles.length >= 10) {
                            dz.removeFile(file);
                            toastr.warning('Maximum 10 files are allowed.');
                        } else {
                            selectedFiles.push(file);
                        }
                    });

                    dz.on("removedfile", function(file) {
                        var index = selectedFiles.indexOf(file);
                        if (index > -1) {
                            selectedFiles.splice(index, 1);
                        }
                    });
                }
            });

            $('#saveAttachments').click(function() {
                selectedFiles.forEach(function(file, index) {
                    $('#attachmentsPreview').append(`
                        <div class="position-relative attachment-container m-2">
                            <a href="#" target="_blank" data-title="${file.name}">
                                <i class="fa fa-file-pdf-o fa-5x text-danger attachment-icon"></i>
                            </a>
                            <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                            <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}">&times;</button>
                            <input type="hidden" name="attachments[]" value="${file.name}">
                        </div>
                    `);
                });

                $('#attachmentsModal').modal('hide');
            });

            $(document).on('click', '.remove-preview', function() {
                var index = $(this).data('index');
                selectedFiles.splice(index, 1); // Remove from selected files array
                $(this).parent().remove(); // Remove the preview from the UI
            });

            // Handle removal of existing attachments
            $(document).on('click', '.remove-existing-attachment', function() {
                var attachmentId = $(this).data('id');
                var $attachmentDiv = $(this).closest('.existing-attachment');

                // Mark the attachment for deletion by adding a hidden input
                $('#createStudentForm').append(`
                    <input type="hidden" name="delete_attachments[]" value="${attachmentId}">
                `);

                // Remove the attachment preview from the UI
                $attachmentDiv.remove();
            });

            // === Add this block for AJAX form submit with attachments ===
            $('#createStudentForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                selectedFiles.forEach(function(file) {
                    formData.append('attachments[]', file);
                });

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Student updated successfully!');
                        window.location.href = "{{ route('students.index') }}";
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred while submitting the form.');
                        $('#submit').prop('disabled', false).text('Submit');
                    }
                });
            });
            // === End block ===
        });
    </script>
@endsection
