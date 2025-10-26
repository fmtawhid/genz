

@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Add Teacher</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('teacher.list') }}" class="btn btn-primary"> Teacher List </a>
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
                    <!-- Form to add a new teacher -->
                    <form id="CreateTeacher" action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Teacher Name -->
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text"
                                    id="name" placeholder="Enter Teacher Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Teacher Designation -->
                            <div class="mb-3 col-md-6">
                                <label for="designation" class="form-label">Designation <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="designation" value="{{ old('designation') }}"
                                    type="text" id="designation" placeholder="Enter Teacher Designation" required>
                                @error('designation')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Teacher Image -->
                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="image" id="image" accept="image/*"
                                    required>
                                @error('image')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- New Fields -->
                        <div class="row">
                            <!-- Phone Number -->
                            <div class="mb-3 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input class="form-control" name="phone_number" value="{{ old('phone_number') }}"
                                    type="text" id="phone_number" placeholder="Enter Teacher Phone Number">
                                @error('phone_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" name="email" value="{{ old('email') }}" type="email"
                                    id="email" placeholder="Enter Teacher Email">
                                @error('email')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Address -->
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Enter Teacher Address">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Facebook Link -->
                            <div class="mb-3 col-md-6">
                                <label for="facebook_link" class="form-label">Facebook Link</label>
                                <input class="form-control" name="facebook_link" value="{{ old('facebook_link') }}"
                                    type="url" id="facebook_link" placeholder="Enter Teacher Facebook Link">
                                @error('facebook_link')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Date of Joining -->
                            <div class="mb-3 col-md-6">
                                <label for="date_of_joining" class="form-label">Date of Joining</label>
                                <input class="form-control" name="date_of_joining" value="{{ old('date_of_joining') }}"
                                    type="date" id="date_of_joining">
                                @error('date_of_joining')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Salary -->
                            <div class="mb-3 col-md-6">
                                <label for="salary" class="form-label">Salary</label>
                                <input class="form-control" name="salary" value="{{ old('salary') }}" type="number"
                                    id="salary" placeholder="Enter Teacher Salary">
                                @error('salary')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Qualification -->
                            <div class="mb-3 col-md-6">
                                <label for="qualification" class="form-label">Qualification</label>
                                <input class="form-control" name="qualification" value="{{ old('qualification') }}"
                                    type="text" id="qualification" placeholder="Enter Teacher Qualification">
                                @error('qualification')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Years of Experience -->
                            <div class="mb-3 col-md-6">
                                <label for="years_of_experience" class="form-label">Years of Experience</label>
                                <input class="form-control" name="years_of_experience"
                                    value="{{ old('years_of_experience') }}" type="number" id="years_of_experience"
                                    placeholder="Enter Teacher's Years of Experience">
                                @error('years_of_experience')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="mb-3 col-md-6">
                                <label for="department" class="form-label">Department</label>
                                <input class="form-control" name="department" value="{{ old('department') }}"
                                    type="text" id="department" placeholder="Enter Teacher's Department">
                                @error('department')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Staff Type -->
                            <div class="mb-3 col-md-6">
                                <label for="staff_type" class="form-label">Staff Type</label>
                                <select class="form-control" name="staff_type" id="staff_type">
                                    <option value="teacher" {{ old('staff_type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                    <option value="staff" {{ old('staff_type') == 'staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                                @error('staff_type')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3 col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input class="form-control" name="date_of_birth" type="date" id="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Blood Group -->
                            <div class="mb-3 col-md-4">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <input class="form-control" name="blood_group" type="text" id="blood_group" value="{{ old('blood_group') }}"
                                    placeholder="Enter Teacher's Blood Group (e.g., O+, A-)">
                                @error('blood_group')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- User ID -->
                            <div class="mb-3 col-md-4">
                                <label for="user_id" class="form-label">User ID</label>
                                <input class="form-control" name="user_id" type="text" id="user_id" value="{{ old('user_id') }}"
                                    placeholder="Enter Teacher's Unique User ID">
                                @error('user_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- User NID -->
                            <div class="mb-3 col-md-4">
                                <label for="nid_number" class="form-label">NID Number</label>
                                <input class="form-control" name="nid_number" type="text" id="nid_number" value="{{ old('nid_number') }}"
                                    placeholder="Enter Teacher's Unique User ID">
                                @error('nid_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Attachments Section -->
                            <div class="mb-3 col-md-12">
                                <button type="button" class="btn btn-primary upload-btn" data-bs-toggle="modal"
                                    data-bs-target="#attachmentsModal">
                                    <i class="fas fa-upload"></i> Upload Attachments
                                </button>
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
@endsection
@section('scripts')
    <script>
        $("#date").flatpickr({
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
                            <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}">
                                &times;
                            </button>
                            <input type="hidden" name="attachments[]" value="${file.name}">
                        </div>
                    `);
                });

                $('#attachmentsModal').modal('hide');
            });

            $('#CreateTeacher').submit(function(event) {
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
                        toastr.success(response.success);
                        window.location.href = "{{ route('teacher.list') }}";
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred while submitting the form.');
                        $('#submit').prop('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endsection