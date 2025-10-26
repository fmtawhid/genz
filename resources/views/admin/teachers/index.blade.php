{{-- @extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Teacher</h4>
                <ol class="breadcrumb m-0">
                    @can('teacher_add')
                    <li class="breadcrumb-item">
                        <a href="{{ route('teacher.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Teacher
                        </a>
                    </li>
                    @endcan
                </ol>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Teachers Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="teacher_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this teacher?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Function to set the action of the delete form and show the modal
        function confirmDelete(teacherId) {
            var formAction = '{{ route('teacher.destroy', ':id') }}';
            formAction = formAction.replace(':id', teacherId);

            // Set the form action dynamically
            document.getElementById('deleteForm').action = formAction;

            // Show the modal
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>

    <script>
        $(document).ready(function() {

            // Initialize DataTable
            $("#teacher_table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('teacher.list') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "image",
                        name: "image",
                        render: function(data, type, row) {
                            // Check if image exists, else show a placeholder image
                            return data ? '<img src="{{ asset('img/teachers') }}/' + data +
                                '" alt="Profile Image" style="width: 50px; height: 50px; object-fit: cover;">' :
                                '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGhFuhp-J1n_y1pfRjcFoRe_PFPgqXXt4OwafWjwoBuTfIbaRQX0Tt5F4&s" alt="Default Image" style="width: 50px; height: 50px; object-fit: cover;">';
                        }
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "designation",
                        name: "designation"
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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ajax error: ", textStatus, errorThrown);
                },
            });
        });
    </script>
@endsection --}}
@extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Teacher</h4>
                <ol class="breadcrumb m-0">
                @can('teacher_add')
                    <li class="breadcrumb-item">
                        <a href="{{ route('teacher.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Teacher
                        </a>
                    </li>
                @endcan
                </ol>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Teachers Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="teacher_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Image</th>
                                <th>Staff Type</th> <!-- New Column -->
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Phone Number</th> <!-- Added Column -->
                                <th>Email</th> <!-- Added Column -->
                                <th>Address</th> <!-- Added Column -->
                                <th>Facebook Link</th> <!-- Added Column -->
                                <th>Joining Date</th> <!-- Added Column -->
                                <th>Salary</th> <!-- Added Column -->
                                <th>Qualification</th> <!-- Added Column -->
                                <th>Status</th> <!-- Added Column -->
                                <th>Years of Experience</th> <!-- Added Column -->
                                <th>Department</th> <!-- Added Column -->
                                <th>Date of Birth</th> <!-- New Column -->
                                <th>Blood Group</th> <!-- New Column -->
                                <th>User ID</th> <!-- New Column -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data is fetched by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this teacher?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // Initialize DataTable
            $("#teacher_table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('teacher.list') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    
                    {
                        data: "image",
                        name: "image",
                        render: function(data, type, row) {
                            return data ? '<img src="{{ asset('img/teachers') }}/' + data +
                                '" alt="Profile Image" style="width: 50px; height: 50px; object-fit: cover;">' :
                                '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGhFuhp-J1n_y1pfRjcFoRe_PFPgqXXt4OwafWjwoBuTfIbaRQX0Tt5F4&s" alt="Default Image" style="width: 50px; height: 50px; object-fit: cover;">';
                        }
                    },
                    
                    {
                        data: "staff_type",
                        name: "staff_type"
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "designation",
                        name: "designation"
                    },
                    {
                        data: "phone_number",
                        name: "phone_number"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "address",
                        name: "address"
                    },
                    {
                        data: "facebook_link",
                        name: "facebook_link"
                    },
                    {
                        data: "date_of_joining",
                        name: "date_of_joining"
                    },
                    {
                        data: "salary",
                        name: "salary"
                    },
                    {
                        data: "qualification",
                        name: "qualification"
                    },
                    {
                        data: "status",
                        name: "status"
                    },
                    {
                        data: "years_of_experience",
                        name: "years_of_experience"
                    },
                    {
                        data: "department",
                        name: "department"
                    },
                    {
                        data: "date_of_birth",
                        name: "date_of_birth"
                    },
                    {
                        data: "blood_group",
                        name: "blood_group"
                    },
                    {
                        data: "user_id",
                        name: "user_id"
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
                                cancel: function() {}
                            },
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ajax error: ", textStatus, errorThrown);
                },
            });
        });
    </script>
@endsection
