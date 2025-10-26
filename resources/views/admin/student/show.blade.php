@extends('layouts.admin_master')

@section('content')
    <div class="container bg-white py-2 shadow-sm shadow-lg">
        <div class="profile-container">
            <div class="row mt-3">
                <div class="col-4 text-center">
                    <div class="profile-header">

                        {{-- <img src="{{ asset('img/profile/' . $student->image) }}" alt="Profile Picture" style="width: 130px;"> --}}
                        <img src="{{ asset($student->image ? 'img/profile/' . $student->image : 'https://pinnacle.works/wp-content/uploads/2022/06/dummy-image.jpg') }}"
                            alt="Profile Picture" style="width: 130px;">
                    </div>

                </div>
                <div class="col-8">
                    <h3>{{ $student->student_name }} </h3>
                    <h4 class="text-muted">ID Number - {{ $student->dhakila_number }}</h4>
                    <div class="">
                        
                    </div>
                </div>
            </div>
            <hr>
            <style>
                .nav-tabs .active a {
                    color: #3f52b5;
                }
            </style>

            <ul class="nav nav-tabs" role="tablist" style="padding-bottom: 15px">
                <li class="mx-2 @if ($activeTab == 'basic-info') active @endif">
                    <a href="#basic-info" role="tab" data-toggle="tab">Basic Information</a>
                </li>
                <li class="mx-2 @if ($activeTab == 'payment-info') active @endif">
                    <a href="#payment-info" role="tab" data-toggle="tab">Payment Info</a>
                </li>
                
                <li class="mx-2 @if ($activeTab == 'document-info') active @endif">
                    <a href="#document-info" role="tab" data-toggle="tab">Document Info</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Basic Information Tab -->
                <div class="tab-pane mt-3 mx-2 active" id="basic-info">

                    <div class="bg-white p-6 rounded-lg">
                        <h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">Basic & Class Information</h3>
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-6">
                                <div class="p-6 bg-gray-50 rounded-lg">
                                    <h4 class="text-xl font-semibold text-gray-700 mb-4">Basic Information</h4>
                                    
                                    <p class="text-gray-600 mb-2"><strong>Whatsapp Number:</strong>

                                        {{ $student->emergency_contact }}</p>
                                    <p class="text-gray-600 mb-2"><strong>Father Name:</strong> {{ $student->father_name }}
                                    </p>
                                    <p class="text-gray-600 mb-2"><strong>Father Phone:</strong> <a href="tel:+{{ $student->mobile }}" class="text-blue-500 hover:underline">{{ $student->mobile }}</a></p>
                                    <p class="text-gray-600 mb-2"><strong>Mother Name:</strong>{{ $student->mobile }}</p>
                                    <p class="text-gray-600 mb-2"><strong>Mother Phone:</strong> <a href="tel:+{{ $student->mother_phone }}" class="text-blue-500 hover:underline">{{ $student->mobile }}</a></p>

                                    <p class="text-gray-600 mb-2"><strong>Present address :</strong> {{ $student->district }}</p>
                                    <p class="text-gray-600 mb-2"><strong>Email:</strong> {{ $student->email }}</p>

                                    <p class="text-gray-600 mb-2"><strong>Date of Birth:</strong>
                                        {{ $student->date_of_birth }}</p>
                                </div>
                            </div>

                            <!-- Class Information -->
                            <div class="col-6">
                                <div class="p-6 bg-gray-50 rounded-lg">
                                    <h4 class="text-xl font-semibold text-gray-700 mb-4">Class Information</h4>
                                    <p class="text-gray-600 mb-2"><strong>Bibag:</strong>
                                        {{ $student->bibag ? $student->bibag->name : 'No Bibag Assigned' }}</p>
                                    <p class="text-gray-600 mb-2"><strong>Roll Number:</strong> {{ $student->roll_number }}
                                    </p>
                                    
                                    <p class="text-gray-600 mb-2"><strong>Form Number:</strong> {{ $student->form_number }}
                                    </p>
                                    <p class="text-gray-600 mb-2"><strong>User ID:</strong>
                                        {{ $student->dhakila_number }}</p>
                                    <p class="text-gray-600"><strong>Student Registration Date:</strong> {{ $student->dhakila_date }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information Tab -->
                {{-- <div class="tab-pane mt-3 mx-2" id="payment-info">

                    <h3>Payment History</h3>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Reciept Number</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Purpose</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <th scope="row">{{ $payment->reciept_no }}</th>
                                    <td>{{ $payment->date }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->purpose->purpose_name }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>



                </div> --}}
                <div class="tab-pane mt-3 mx-2" id="payment-info">
                    <h3>Payment History</h3>
                    <table id="payments_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reciept Number</th>
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


                <!-- Payment Information Tab -->
                <div class="tab-pane mt-3 mx-2" id="document-info">

                    @if ($attachments->isEmpty())
                        <p>No attachments found for this student.</p>
                    @else
                        <ul>
                            @foreach ($attachments as $attachment)
                                <li>
                                    <a href="{{ asset($attachment->file_path) }}"
                                        target="_blank">{{ $attachment->file_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <hr>
                    @if ($attachments->isEmpty())
                        <div class="col-12">
                            <p class="text-center">No attachments found for this student.</p>
                        </div>
                    @else
                        @foreach ($attachments as $attachment)
                            <div class="col-md-3 mb-3">
                                @php
                                    $filePath = asset('assets/attachements/' . $attachment->file_path); // Ensure the path starts with 'assets/attachements/'
                                    $fileType = strtolower(pathinfo($attachment->file_name, PATHINFO_EXTENSION));
                                @endphp

                                @if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                    <!-- Display image using Lightbox -->
                                    <a href="{{ $filePath }}" data-lightbox="attachements"
                                        data-title="{{ $attachment->file_name }}">
                                        <img src="{{ $filePath }}" alt="{{ $attachment->file_name }}"
                                            class="img-fluid img-thumbnail">
                                    </a>
                                @elseif($fileType == 'pdf')
                                    <!-- Display PDF icon with link to view/download -->
                                    <a href="{{ $filePath }}" target="_blank"
                                        data-title="{{ $attachment->file_name }}">
                                        <i class="fa fa-file-pdf-o fa-5x text-danger"></i>
                                        <p>{{ $attachment->file_name }}</p>
                                    </a>
                                    <a href="{{ $filePath }}" download class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                @else
                                    <!-- Handle other file types if necessary -->
                                    <p>{{ $attachment->file_name }} (Unsupported file type)</p>
                                @endif
                            </div>
                        @endforeach
                    @endif


                </div>



            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Activate the first tab by default
            $('.nav-tabs a:first').tab('show');
        });
    </script>
    <script>
    $(document).ready(function() {
        // Initialize DataTable for Payment
        $('#payments_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.student.payments', $student->dhakila_number) }}",
                dataSrc: function (json) {
                    console.log(json);  // Check the structure of your response here
                    return json.data || json;  // Adjust if your data is nested inside `data`
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
            language: {
                processing: "Loading..."
            }
        });


        // Initialize DataTable for Attendance
        $('#attendance_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.student.attendances', $student->id) }}",
                dataSrc: function (json) {
                    console.log(json);  // Check the structure of your response here
                    return json.data || json;  // Adjust if your data is nested inside `data`
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'date', name: 'date' },
                { data: 'attendance_type', name: 'attendance_type' },
                { data: 'remark', name: 'remark' }
            ],
            responsive: true,
            language: {
                processing: "Loading..."
            }
        });
    });
</script>

    <!-- <script>
        $(document).ready(function() {
            // Initialize DataTable for Attendance
            $('#attendance_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.student.attendances', $student->dhakila_number) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, // Serial Number - Not Searchable
                    {
                        data: 'date',
                        name: 'date',
                        searchable: false,
                        render: function(data, type, row) {
                            if (data) {
                                // Assuming the date is in ISO format (e.g., '2025-02-10')
                                var date = new Date(data);
                                var day = String(date.getDate()).padStart(2,
                                '0'); // Adds leading zero to day
                                var month = String(date.getMonth() + 1).padStart(2,
                                '0'); // Adds leading zero to month
                                var year = date.getFullYear();
                                return day + '-' + month + '-' + year; // Return formatted date
                            }
                            return ''; // Return empty if no date is available
                        }
                    },
                    {
                        data: 'attendance_type',
                        name: 'attendance_type',
                        searchable: false // Disable search for attendance type
                    },
                    {
                        data: 'remark',
                        name: 'remark',
                        searchable: false // Disable search for remarks
                    }
                ],

                responsive: true,
                language: {
                    processing: "Loading..."
                }
            });

            // Ensure the first tab is activated by default
            $('.nav-tabs a:first').tab('show');
        });
    </script> -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
@endsection



