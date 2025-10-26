<!DOCTYPE html>
<html lang="en">

<head>
    @inject('settings', 'App\Models\Setting')
    @php
        $setting = $settings::find(1);
    @endphp
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $setting->name }}</title>
    <link rel="icon" type="image/x-icon" href='{{ asset("assets/setting/$setting->favicon") }}'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/vendor/daterangepicker/daterangepicker.css') }}">

    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="{{ asset('assets/admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/admin/assets/js/config.js') }}"></script>

    {{-- Image Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/image_upload/dist/image-uploader.min.css') }}">


    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Cropper Css --}}
    {{--
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/dist/css/cropper.css') }}">


    <!-- Datatables css -->
    <link href="{{ asset('assets/admin/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/admin/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/admin/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/admin/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Include jQuery Confirm CSS (optional for styling) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">


    <!-- Quill css -->
    <link href="{{ asset('assets/admin/assets/vendor/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />

    <!-- Flatpickr Timepicker css -->
    <link href="{{ asset('assets/admin/assets/vendor/flatpickr/flatpickr.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">



    <!-- Icons css -->
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Select2 --}}
    {{--
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    --}}

    <!-- Select2 css -->
    <link href="{{ asset('assets/admin/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet"
        type="text/css" />


    <!-- App css -->
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <style>
        /* .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: #007bff !important;
            border-color: #006fe6 !important;
        } */

        .toast-success {
            background-color: #51A351 !important;
        }
    </style>

    <style>
        .multi-line-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>


    <style>
        /* Custom styles for the upload button */
        .upload-btn {
            position: relative;
            overflow: hidden;
        }

        .upload-btn .fa-upload {
            margin-right: 8px;
        }

        .upload-btn:hover {
            background-color: #0069d9;
            /* Darker shade for hover */
            color: #fff;
        }

        /* Custom styles for the save button in modal */
        .save-btn {
            position: relative;
            overflow: hidden;
        }

        .save-btn .fa-save {
            margin-right: 8px;
        }

        .save-btn:hover {
            background-color: #28a745;
            /* Darker shade for hover */
            color: #fff;
        }

        /* Style for attachment previews */
        .attachment-preview {
            position: relative;
        }

        .attachment-preview img {
            border-radius: 5px;
        }

        .attachment-preview .remove-preview {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 22px;
            cursor: pointer;
        }

        .attachment-preview .remove-preview:hover {
            background-color: rgba(255, 0, 0, 1);
        }

        .toast-error {
            background: rgba(255, 0, 0, 0.7) !important;
            color: #fff !important;
        }

        #toast-container>.toast-error {
            background-image: inherit !important;
        }


        .existing-attachment {
            width: 150px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f9fa;
        }

        /* Ensure images fit within the container */
        .attachment-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Style for PDF and other file icons */
        .attachment-icon {
            display: block;
            margin: 0 auto;
            padding-top: 10px;
        }

        /* Positioning and styling the delete button */
        .remove-existing-attachment {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(220, 53, 69, 0.9);
            /* Bootstrap danger color with transparency */
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }

        .remove-existing-attachment:hover {
            background-color: rgba(220, 53, 69, 1);
            /* Fully opaque on hover */
        }

        /* Attachment name styling */
        .attachment-name {
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Hover effect for attachment containers */
        .existing-attachment:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e9ecef;
        }


        .attachment-container {
            width: 150px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f9fa;
            position: relative;
        }

        .attachment-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .attachment-icon {
            display: block;
            margin: 10px auto 0 auto;
        }

        .attachment-name {
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }

        .remove-preview {
            background-color: rgba(220, 53, 69, 0.9);
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }

        .remove-preview:hover {
            background-color: rgba(220, 53, 69, 1);
        }

        .attachment-container:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e9ecef;
        }

        .heading-light {
            color: #000;
            font-size: 12px;
            padding: 15px 16px;
            margin-bottom: 0px !important;
            font-weight: bold;
        }

        .heading-dark {
            color: #fff;
            font-size: 12px;
            padding: 15px 16px;
            margin-bottom: 0px !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{ url('/panel/dashboard') }}" class="logo-light">
                            <h2 class="heading-dark">GenZ IT Institute</h2>
                            {{-- <span class="logo-lg">
                                <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="small logo">
                            </span> --}}
                        </a>

                        <!-- Logo Dark -->
                        <a href="{{ url('/panel/dashboard') }}" class="logo-dark">
                            <h2 class="heading-light">GenZ IT Institute</h2>
                            {{-- <span class="logo-lg">
                                <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="small logo">
                            </span> --}}
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="ri-menu-2-fill"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">


                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode">
                            <i class="ri-moon-fill fs-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="#" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line fs-22"></i>
                        </a>
                    </li>

                    <li class="dropdown me-md-2">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ asset('assets/admin/assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                    width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ Auth::user()->name }}</h5>
                                <h6 class="my-0 fw-normal">{{ Auth::user()->roles[0]->name ?? 'Student' }}
                                </h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-account-circle-fill align-middle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-settings-4-fill align-middle me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="pages-faq.html" class="dropdown-item">
                                <i class="ri-customer-service-2-fill align-middle me-1"></i>
                                <span>Support</span>
                            </a>

                            <!-- item-->
                            <a href="auth-lock-screen.html" class="dropdown-item">
                                <i class="ri-lock-password-fill align-middle me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="#" class="dropdown-item d-flex align-items-center">
                                <i class="ri-logout-box-fill align-middle me-1"></i>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->

        <div class="leftside-menu">
            <!-- Brand Logo Light -->
            <a href="{{ url('/panel/dashboard') }}" class="logo logo-light">
                <h2 class="heading-dark">GenZ IT Institute</h2>
                {{-- <span class="logo-lg">
                    <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="small logo">
                </span> --}}
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ url('/panel/dashboard') }}" class="logo logo-dark">
                <h2 class="heading-light">GenZ IT Institute</h2>
                {{-- <span class="logo-lg">
                    <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset(" assets/setting/$setting->logo") }}" alt="small logo">
                </span> --}}
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Leftbar User -->
                <div class="leftbar-user p-3 text-white">
                    <a href="{{ url('/panel/dashboard') }}" class="d-flex align-items-center text-reset">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('assets/admin/assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                height="42" class="rounded-circle shadow">
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <span class="fw-semibold fs-15 d-block">{{ Auth::user()->name }}</span>
                            <span class="fs-13">{{ Auth::user()->roles[0]->name ?? 'Student' }}</span>
                        </div>
                        {{-- <div class="ms-auto">
                            <i class="ri-arrow-right-s-fill fs-20"></i>
                        </div> --}}
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">


                    <li class="side-nav-title mt-1"> Main</li>
                    @if(auth()->user()->role == 'student')
                        <li class="side-nav-item">
                            <a href="{{ url('/panel/studentD') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-line"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('users.change-password') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-line"></i>
                                <span> Change Password </span>
                            </a>
                        </li>
                    @else


                    <li class="side-nav-item">
                        <a href="{{ url('/panel/dashboard') }}" class="side-nav-link">
                            <i class="ri-dashboard-2-line"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>


                    @can('student_view')
                        <li class="side-nav-item">
                            <a href="{{ route('student.profile') }}" class="side-nav-link">
                                <i class="ri-profile-line"></i> <!-- Profile icon -->
                                <span> Student Profile </span>
                            </a>
                        </li>
                    @endcan
                    @can('sms_add')
                        <!-- <li class="side-nav-item">
                            <a href="{{ route('sms.form') }}" class="side-nav-link">
                                <i class="ri-message-line"></i>
                                <span> Sent SMS </span>
                            </a>
                        </li> -->
                    @endcan

                    <!-- Admission Section -->
                    @canany(['student_view', 'student_add', 'student_edit', 'student_delete'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#productMenu" aria-expanded="false" class="side-nav-link">
                                <i class="ri-user-add-line"></i>
                                <span>Admission</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="productMenu">
                                <ul class="side-nav-second-level">
                                    @can('student_add')
                                        <li><a href="{{ route('students.create') }}">Admission</a></li>
                                    @endcan
                                    @can('student_view')
                                        <li><a href="{{ route('students.index') }}">All Student</a></li>
                                        <li><a href="{{ route('students.inactive') }}">Inactive Student</a></li>
                                        <!-- <li><a href="{{ route('optional-services.index') }}">Service (bus, daycaring)</a></li>
                                        <li><a href="{{ route('assign-optional-service.create') }}">Assign Service</a></li> -->

                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcanany

                  
                    <!-- Expenses Section -->
                    @canany(['expense_view', 'expense_add', 'expense_edit', 'expense_delete', 'expense_head_view', 'expense_head_add', 'expense_head_edit', 'expense_head_delete'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#expensesmenu" aria-expanded="false" class="side-nav-link">
                                <i class="ri-money-dollar-circle-line"></i>
                                <span>Expenses</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="expensesmenu">
                                <ul class="side-nav-second-level">
                                    @can('expense_add')
                                        <li><a href="{{ route('expenses.index') }}">Expenses</a></li>
                                    @endcan
                                    <!-- @can('expense_add')
                                            <li><a href="{{ route('expenses.create') }}">Add Expense</a></li>
                                        @endcan -->
                                    @can('expense_view')
                                        <li><a href="{{ route('expense.report') }}">Expense Report</a></li>
                                    @endcan
                                    @can('expense_head_view')
                                        <li><a href="{{ route('expense_heads.index') }}">All Expense Head</a></li>
                                    @endcan
                                    @can('expense_head_add')
                                        <li><a href="{{ route('expense_heads.create') }}">Add Expense Head</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany

                    <!-- Payments Section -->
                    @canany(['payment_view', 'payment_add', 'payment_edit', 'payment_delete', 'purpose_view', 'purpose_add', 'purpose_edit', 'purpose_delete'])
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#paymentsmenu" aria-expanded="false" class="side-nav-link">
                            <i class="ri-bank-card-line"></i>
                            <span>Payments</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="paymentsmenu">
                            <ul class="side-nav-second-level">
                                @canany(['payment_add', 'payment_view'])
                                <li><a href="{{ route('payments.index') }}">Payments</a></li>
                                @endcan
                                @can('payment_view')
                                    <li><a href="{{ route('payments.report') }}">Payment Report</a></li>
                                @endcan
                                <!-- @can('payment_view')
                                    <li><a href="{{ route('students.due') }}">Students Due</a></li>
                                @endcan
                                @can('payment_view')
                                    <li><a href="{{ route('fee-categories.index') }}">All Fees Added</a></li>
                                @endcan -->
                                @canany(['purpose_view', 'purpose_add', 'purpose_edit', 'purpose_delete'])
                                    <li><a href="{{ route('purposes.index') }}">Purposes</a></li>
                                @endcanany
                            </ul>
                        </div>
                    </li>
                @endcanany

                    <!-- Notices Section -->
                    @canany(['notice_add', 'notice_view', 'notice_edit', 'notice_delete'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#notice" aria-expanded="false" class="side-nav-link">
                                <i class="ri-notification-3-line"></i>
                                <span>Notices</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="notice">
                                <ul class="side-nav-second-level">
                                    @can('notice_add')
                                        <li><a href="{{ route('notices.add') }}">Add Notice</a></li>
                                    @endcan
                                    @can('notice_view')
                                        <li><a href="{{ route('notices.list') }}">All Notices</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany

                    <!-- Complaints Section -->
                    @canany(['complaint_view', 'complaint_delete'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#Complaints" aria-expanded="false" class="side-nav-link">
                                <i class="ri-folder-3-line"></i>
                                <span>Complaints</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="Complaints">
                                <ul class="side-nav-second-level">
                                    @can('complaint_view')
                                        <li><a href="{{ route('complaints.index') }}">All Complaints</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany


                    <!-- Gallery Section -->
                    @canany(['gallery_view', 'gallery_add', 'gallery_edit', 'gallery_delete'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#gallery" aria-expanded="false" class="side-nav-link">
                                <i class="ri-gallery-line"></i>
                                <span>Gallery</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="gallery">
                                <ul class="side-nav-second-level">
                                    @can('gallery_add')
                                        <li><a href="{{ route('gallery.create') }}">Add Gallery Image</a></li>
                                    @endcan
                                    @can('gallery_view')
                                        <li><a href="{{ route('gallery.list') }}">All Gallery Images</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany

                    <!-- Teacher Section -->
                    @canany(['teacher_view', 'teacher_add', 'teacher_edit', 'teacher_delete'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#teachersmenu" aria-expanded="false" class="side-nav-link">
                                <i class="ri-user-line"></i>
                                <span>Teachers & Staffs</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="teachersmenu">
                                <ul class="side-nav-second-level">
                                    @can('teacher_add')
                                        <li><a href="{{ route('teacher.create') }}">Add Teacher & Staffs</a></li>
                                    @endcan
                                    @can('teacher_view')
                                        <li><a href="{{ route('teacher.list') }}">All Teachers & Staffs</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany

                    <!-- Authentication Section -->
                    @canany(['user_view', 'permission_view', 'role_view'])
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="sidebarTasks"
                                class="side-nav-link">
                                <i class="ri-settings-line"></i>
                                <span>Authentications</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="auth">
                                <ul class="side-nav-second-level">
                                    @can('user_view')
                                        <li>
                                            <a href="{{ route('users.index') }}">Users</a>
                                        </li>

                                    @endcan
                                    @can('permission_view')
                                        <li>
                                            <a href="{{ route('permissions.index') }}">Permissions</a>
                                        </li>
                                    @endcan
                                    @can('role_view')
                                        <li>
                                            <a href="{{ route('roles.index') }}">Roles</a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcanany

                    @canany(['setting_view', 'sreni_view', 'sreni_add', 'sreni_edit', 'sreni_delete', 'bibag_view', 'bibag_add', 'bibag_edit', 'bibag_delete'])
                        <!-- Setting  Section -->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#settingmenu" aria-expanded="false"
                                aria-controls="sidebarTasks" class="side-nav-link">
                                <i class="ri-settings-line"></i>
                                <span>Setting</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="settingmenu">
                                <ul class="side-nav-second-level">
                                    @can('setting_view')
                                        <li>
                                            <a href="{{ route('setting.index') }}">Manage Setting</a>
                                        </li>
                                    @endcan
                                    @canany(['sreni_view', 'sreni_add', 'sreni_edit', 'sreni_delete'])
                                        <li><a href="{{ route('srenis.index') }}">Classes</a></li>
                                        <li><a href="{{ route('sreni-sections.index') }}">Sreni Section</a></li>
                                    @endcanany
                                    @canany(['bibag_view', 'bibag_add', 'bibag_edit', 'bibag_delete'])
                                        <li><a href="{{ route('bibags.index') }}">Bibhag</a></li>
                                    @endcanany

                                </ul>
                            </div>
                        </li>
                    @endcanany
                    @endif




                    <!-- Trush Section
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#trush" aria-expanded="false" aria-controls="sidebarTasks"
                    class="side-nav-link">
                    <i class="ri-notification-3-line"></i>
                    <span>Trush</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="trush">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Trush Notice</a>
                        </li>
                    </ul>
                </div>
            </li> -->


                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © <a href="https://fmtawhid.github.io" target="_blank">fmtawhid</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
            <h5 class="text-white m-0">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="card mb-0 p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <h5 class="mt-0 fs-16 fw-bold mb-3">Choose Layout</h5>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input id="customizer-layout01" name="data-layout" type="checkbox" value="vertical"
                                class="form-check-input">
                            <label class="form-check-label" for="customizer-layout01">Vertical</label>
                        </div>
                        <div class="form-check form-switch">
                            <input id="customizer-layout02" name="data-layout" type="checkbox" value="horizontal"
                                class="form-check-input">
                            <label class="form-check-label" for="customizer-layout02">Horizontal</label>
                        </div>
                    </div>

                    <h5 class="my-3 fs-16 fw-bold">Color Scheme</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light"
                                value="light">
                            <label class="form-check-label" for="layout-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark"
                                value="dark">
                            <label class="form-check-label" for="layout-color-dark">Dark</label>
                        </div>
                    </div>

                    <div id="layout-width">
                        <h5 class="my-3 fs-16 fw-bold">Layout Mode</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                    id="layout-mode-fluid" value="fluid">
                                <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                            </div>

                            <div id="layout-boxed">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                        id="layout-mode-boxed" value="boxed">
                                    <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                                </div>
                            </div>

                            <div id="layout-detached">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                        id="data-layout-detached" value="detached">
                                    <label class="form-check-label" for="data-layout-detached">Detached</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="my-3 fs-16 fw-bold">Topbar Color</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color"
                                id="topbar-color-light" value="light">
                            <label class="form-check-label" for="topbar-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color"
                                id="topbar-color-dark" value="dark">
                            <label class="form-check-label" for="topbar-color-dark">Dark</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color"
                                id="topbar-color-brand" value="brand">
                            <label class="form-check-label" for="topbar-color-brand">Brand</label>
                        </div>
                    </div>

                    <div>
                        <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color"
                                    id="leftbar-color-light" value="light">
                                <label class="form-check-label" for="leftbar-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color"
                                    id="leftbar-color-dark" value="dark">
                                <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color"
                                    id="leftbar-color-brand" value="brand">
                                <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-default" value="default">
                                <label class="form-check-label" for="leftbar-size-default">Default</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-compact" value="compact">
                                <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-small" value="condensed">
                                <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-small-hover" value="sm-hover">
                                <label class="form-check-label" for="leftbar-size-small-hover">Hover View</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-full" value="full">
                                <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-fullscreen" value="fullscreen">
                                <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen
                                    Layout</label>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                        <div class="btn-group checkbox" role="group">
                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed"
                                value="fixed">
                            <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                            <input type="radio" class="btn-check" name="data-layout-position"
                                id="layout-position-scrollable" value="scrollable">
                            <label class="btn btn-soft-primary w-sm ms-0"
                                for="layout-position-scrollable">Scrollable</label>
                        </div>
                    </div>

                    <div id="sidebar-user">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <label class="fs-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="sidebar-user"
                                    id="sidebaruser-check">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Vendor js -->
    <script src="{{ asset('assets/admin/assets/js/vendor.min.js') }}"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- Select 2 --}}
    {{--
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script> --}}
    <!--  Select2 Plugin Js -->
    <script src="{{ asset('assets/admin/assets/vendor/select2/js/select2.min.js') }}"></script>

    {{-- Image Upload --}}
    <script type="text/javascript" src="{{ asset('assets/image_upload/dist/image-uploader.min.js') }}"></script>

    {{-- Cropper js --}}
    {{--
    <script src="https://unpkg.com/dropzone@6.0.0-beta.2/dist/dropzone.js"></script> --}}
    <script src="https://unpkg.com/cropperjs@1.6.1/dist/cropper.js"></script>
    <script src="{{ asset('assets/dist/js/cropper.js') }}"></script>


    <!-- Datatables js -->
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/admin/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
        </script>
    <script
        src="{{ asset('assets/admin/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}">
        </script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/admin/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script
        src="{{ asset('assets/admin/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- DataTables Buttons Extension JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    <!-- Buttons ColVis JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>


    <!-- Daterangepicker js -->
    <script src="{{ asset('assets/admin/assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Apex Charts js -->
    <script src="{{ asset('assets/admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map js -->
    <script
        src="{{ asset('assets/admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
        </script>
    <script
        src="{{ asset('assets/admin/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
        </script>

    <!-- Quill Editor js -->
    <script src="{{ asset('assets/admin/assets/vendor/quill/quill.min.js') }}"></script>

    <!-- Quill Demo js -->
    {{--
    <script src="{{ asset('assets/admin/assets/js/pages/demo.quilljs.js') }}"></script> --}}

    <!-- Include jQuery Confirm plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

    <!-- Bootstrap Wizard Form js -->
    <script src="{{ asset('assets/admin/assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}">
    </script>

    {{-- Dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- Dashboard App js -->
    {{--
    <script src="{{ asset('assets/admin/assets/js/pages/demo.dashboard.js') }}"></script> --}}

    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- Flatpickr Timepicker Plugin js -->
    <script src="{{ asset('assets/admin/assets/vendor/flatpickr/flatpickr.min.js') }}"></script>



    <!-- App js -->
    <script src="{{ asset('assets/admin/assets/js/app.min.js') }}"></script>



    @if (session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}");
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}");
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            toastr.info("{{ session()->get('warning') }}");
        </script>
    @endif
    <script>
        // $(function() {
        //     // Summernote
        //     $('.textarea').summernote()
        // })
    </script>



    @yield('scripts')

</body>

</html>