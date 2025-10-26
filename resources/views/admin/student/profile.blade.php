@extends('layouts.admin_master')

@section('content')

    <!-- Search Bar -->
    <div class="bg-white shadow-sm shadow-lg p-1 mt-3">
        <form action="{{ route('student.search') }}" method="GET" class="d-flex my-2 justify-content-end container">
            <input class="form-control form-control-sm w-50 me-2" type="text" name="dhakila_number" placeholder="Enter User ID" required>
            <button type="submit" class="btn btn-success">Search</button>
        </form>

        <!-- Display Error Message if Student Not Found -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (isset($student))
            <div class="container bg-white py-2">
                <div class="profile-container">
                    <div class="row mt-3">
                        <div class="col-4 text-center">
                            <div class="profile-header">
                                <img src="{{ asset($student->image ? 'img/profile/' . $student->image : 'https://pinnacle.works/wp-content/uploads/2022/06/dummy-image.jpg') }}" alt="Profile Picture" style="width: 130px;">
                            </div>
                        </div>
                        <div class="col-8">
                            <h3>{{ $student->student_name }} </h3>
                            <h4 class="text-muted">User ID - {{ $student->dhakila_number }}</h4>
                            <!-- For admin -->
                            <a href="{{ route('admin.student.generateID', ['dhakila_number' => $student->dhakila_number]) }}" class="btn btn-primary">Generate ID Card</a>
                        </div>
                    </div>
                    <hr>
                    <style>
                        .nav-tabs .active a {
                            color: #3f52b5;
                        }
                        .nav-item a {
                            color: #000;
                        }
                    </style>

                    <!-- Tab Links -->
                    <ul class="nav nav-tabs" id="student-tabs" role="tablist" style="padding-bottom: 15px">
                        <li class="mx-2">
                            <a href="#basic-info" role="tab" data-toggle="tab" class="@if ($activeTab == 'basic-info') active @endif">Basic Information</a>
                        </li>
                        <li class="mx-2">
                            <a href="#payment-info" role="tab" data-toggle="tab" class="@if ($activeTab == 'payment-info') active @endif">Payment Info</a>
                        </li>
                        <li class="mx-2">
                            <a href="#document-info" role="tab" data-toggle="tab" class="@if ($activeTab == 'document-info') active @endif">Document Info</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3">
                        <!-- Basic Information Tab -->
                        <div class="tab-pane fade @if ($activeTab == 'basic-info') show active @endif" id="basic-info" role="tabpanel">
                            <div class="bg-white p-6 rounded-lg">
                                <h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">Basic & Class Information</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="p-6 bg-gray-50 rounded-lg">
                                            <h4 class="text-xl font-semibold text-gray-700 mb-4">Basic Information</h4>
                                            <p class="text-gray-600 mb-2"><strong>Whatsapp Number:</strong> {{ $student->emergency_contact }}</p>
                                            <p class="text-gray-600 mb-2"><strong>Father Name:</strong> {{ $student->father_name }}</p>
                                            <p class="text-gray-600 mb-2"><strong>Father Phone:</strong> <a href="tel:+{{ $student->mobile }}" class="text-blue-500 hover:underline">{{ $student->mobile }}</a></p>
                                            <p class="text-gray-600 mb-2"><strong>Mother Name:</strong>{{ $student->mobile }}</a></p>
                                            <p class="text-gray-600 mb-2"><strong>Present address:</strong> {{ $student->district }}</p>
                                            <p class="text-gray-600 mb-2"><strong>Email:</strong> {{ $student->email }}</p>
                                            <p class="text-gray-600 mb-2"><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-6 bg-gray-50 rounded-lg">
                                            <h4 class="text-xl font-semibold text-gray-700 mb-4">Class Information</h4>
                                            <p class="text-gray-600 mb-2"><strong>Bibag:</strong> {{ $student->bibag ? $student->bibag->name : 'No Bibag Assigned' }}</p>
                                            <p class="text-gray-600 mb-2"><strong>Form Number:</strong> {{ $student->form_number }}</p>
                                            <p class="text-gray-600 mb-2"><strong>User ID:</strong> {{ $student->dhakila_number }}</p>
                                            <p class="text-gray-600"><strong>Student Registration Date:</strong> {{ $student->dhakila_date }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information Tab -->
                        <div class="tab-pane fade @if ($activeTab == 'payment-info') show active @endif" id="payment-info" role="tabpanel">
                            <h3>Payment History</h3>
                            <table id="payments_table" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Receipt Number</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Purpose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>



                        <!-- Document Information Tab -->
                        <div class="tab-pane fade @if ($activeTab == 'document-info') show active @endif" id="document-info" role="tabpanel">
                            @if ($attachments->isEmpty())
                                <p>No attachments found for this student.</p>
                            @else
                                <ul>
                                    @foreach ($attachments as $attachment)
                                        <li><a href="{{ asset($attachment->file_path) }}" target="_blank">{{ $attachment->file_name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            @section('scripts')
                <!-- jQuery & DataTables JS and CSS -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
                <script>
                    $(document).ready(function() {
                        // Activate the first tab by default
                        $('.nav-tabs a:first').tab('show');
                    });

                    // Initialize DataTable for Payments
                    $('#payments_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('admin.student.payments', $student->dhakila_number) }}",
                            dataSrc: function (json) {
                                return json.data || json;
                            }
                        },
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                            { data: 'reciept_no', name: 'reciept_no' },
                            { data: 'date', name: 'date' },
                            { data: 'amount', name: 'amount' },
                            { data: 'purpose_name', name: 'purpose_name' }
                        ],
                        responsive: true,
                        pageLength: 10,
                        language: { processing: "Loading..." }
                    });

                    // Initialize DataTable for Attendance
                    $('#attendance_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('admin.student.attendances', $student->id) }}",
                            dataSrc: function (json) {
                                return json.data || json;
                            }
                        },
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                            { data: 'date', name: 'date' },
                            { data: 'attendance_type', name: 'attendance_type' },
                            { data: 'remark', name: 'remark' }
                        ],
                        responsive: true,
                        pageLength: 10,
                        language: { processing: "Loading..." }
                    });
                </script>
            @endsection

        @else
            <div class="d-flex align-items-center justify-content-center" style="height:600px; border:3px solid; font-size:40px;">
                Student Information will appear here
            </div>
        @endif
    </div>

@endsection
