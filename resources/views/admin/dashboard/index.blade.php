@extends('layouts.admin_master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <h2 class="mb-0">Welcome to {{ $settings->name }}</h2>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    @can('dashboard_view')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Customers">Total Students</h5>
                            <h3 class="my-3">{{ $totalStudents }}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                @if ($totalStudentsLast30Days < 0)
                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                        {{ $totalStudentsLast30Days }}</span>
                                @else
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                        {{ $totalStudentsLast30Days }}</span>
                                @endif
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-group-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Revenue">Revenue</h5>
                            <h3 class="my-3"> ৳ {{ $totalAmount }}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                @if ($totalPaymentsLast30Days < 0)
                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                        ৳ {{ $totalPaymentsLast30Days }}</span>
                                @else
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                        ৳ {{ $totalPaymentsLast30Days }}</span>
                                @endif
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-money-dollar-circle-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Orders">Total Profit</h5>
                            <h3 class="my-3"> ৳ {{ $totalProfit }}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                @if ($totalProfitLast30Days < 0)
                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                        ৳ {{ $totalProfitLast30Days }}</span>
                                @else
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                        ৳ {{ $totalProfitLast30Days }}</span>
                                @endif
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-shopping-basket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Growth">Total Cost</h5>
                            <h3 class="my-3"> ৳ {{ $totalExpenses }}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                @if ($totalExpensesLast30Days < 0)
                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                        ৳ {{ $totalExpensesLast30Days }}</span>
                                @else
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                        ৳ {{ $totalExpensesLast30Days }}</span>
                                @endif
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-donut-chart-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Revenue Items</h4>
                    {{-- <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div> --}}
                </div>

                <div class="card-body p-0">
                    <div class="bg-light-subtle border-top border-bottom border-light">
                        <div class="row text-center">
                            @foreach ($revenues->take(5) as $revenue) <!-- First 5 items -->
                                <div class="col">
                                    <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                        {{ $revenue->purpose->purpose_name }} <!-- Replace with the relevant purpose name or description -->
                                    </p>
                                    <h3 class="fw-normal mb-3">
                                        <span>৳{{ number_format($revenue->total_amount) }}</span>
                                    </h3>
                                    <p class="mb-0 text-muted text-truncate mb-3">
                                        @php
                                            // Find the matching payment for the last 30 days
                                            $last30DaysRevenue = $revenuesLast30Days->firstWhere('purpose_id', $revenue->purpose_id);
                                        @endphp
                                        @if ($last30DaysRevenue)
                                            @if ($last30DaysRevenue->total_amount < 0)
                                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                    ৳{{ number_format($last30DaysRevenue->total_amount) }}</span>
                                            @else
                                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                    ৳{{ number_format($last30DaysRevenue->total_amount) }}</span>
                                            @endif
                                        @else
                                            <!-- If no data found for last 30 days, show 0 or handle appropriately -->
                                            <span class="badge bg-secondary me-1"><i class="ri-arrow-up-line"></i>
                                                ৳0</span>
                                        @endif
                                        <span>Since last 30 days</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($revenues->count() > 5) <!-- If there are more than 5 items -->
                    <div class="card-body p-0">
                        <div class="bg-light-subtle border-top border-bottom border-light">
                            <div class="row text-center">
                                @foreach ($revenues->skip(5)->take(5) as $revenue) <!-- 6th to 10th items -->
                                    <div class="col">
                                        <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                            {{ $revenue->purpose_id }} <!-- Replace with the relevant purpose name or description -->
                                        </p>
                                        <h3 class="fw-normal mb-3">
                                            <span>৳{{ number_format($revenue->total_amount) }}</span>
                                        </h3>
                                        <p class="mb-0 text-muted text-truncate mb-3">
                                            @php
                                                // Find the matching payment for the last 30 days
                                                $last30DaysRevenue = $revenuesLast30Days->firstWhere('purpose_id', $revenue->purpose_id);
                                            @endphp
                                            @if ($last30DaysRevenue)
                                                @if ($last30DaysRevenue->total_amount < 0)
                                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                        ৳{{ number_format($last30DaysRevenue->total_amount) }}</span>
                                                @else
                                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                        ৳{{ number_format($last30DaysRevenue->total_amount) }}</span>
                                                @endif
                                            @else
                                                <!-- If no data found for last 30 days, show 0 or handle appropriately -->
                                                <span class="badge bg-secondary me-1"><i class="ri-arrow-up-line"></i>
                                                    ৳0</span>
                                            @endif
                                            <span>Since last 30 days</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Expense Items</h4>
                    {{-- <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body p-0">
                    <div class="bg-light-subtle border-top border-bottom border-light">
                        <div class="row text-center">
                            @foreach ($expenses->take(5) as $expense) <!-- প্রথম ৫টি আইটেম -->
                                <div class="col">
                                    <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                        {{ $expense->expenseHead->expense_head_name }}
                                    </p>
                                    <h3 class="fw-normal mb-3">
                                        <span>৳{{ number_format($expense->total_amount) }}</span>
                                    </h3>
                                    <p class="mb-0 text-muted text-truncate mb-3">
                                        @php
                                            // Find the matching expense for the last 30 days
                                            $last30DaysExpense = $expensesLast30Days->firstWhere('expense_head_id', $expense->expenseHead->id);
                                        @endphp
                                        @if ($last30DaysExpense)
                                            @if ($last30DaysExpense->total_amount < 0)
                                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                    ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                            @else
                                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                    ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                            @endif
                                        @else
                                            <!-- If no data found for last 30 days, show 0 or handle appropriately -->
                                            <span class="badge bg-secondary me-1"><i class="ri-arrow-up-line"></i>
                                                ৳0</span>
                                        @endif
                                        <span>Since last 30 days</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($expenses->count() > 5) <!-- যদি ৫টির বেশি আইটেম থাকে -->
                    <div class="card-body p-0">
                        <div class="bg-light-subtle border-top border-bottom border-light">
                            <div class="row text-center">
                                @foreach ($expenses->skip(5)->take(5) as $expense) <!-- ৬ম থেকে ১০ম আইটেম -->
                                    <div class="col">
                                        <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                            {{ $expense->expenseHead->expense_head_name }}
                                        </p>
                                        <h3 class="fw-normal mb-3">
                                            <span>৳{{ number_format($expense->total_amount) }}</span>
                                        </h3>
                                        <p class="mb-0 text-muted text-truncate mb-3">
                                            @php
                                                // Find the matching expense for the last 30 days
                                                $last30DaysExpense = $expensesLast30Days->firstWhere('expense_head_id', $expense->expenseHead->id);
                                            @endphp
                                            @if ($last30DaysExpense)
                                                @if ($last30DaysExpense->total_amount < 0)
                                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                        ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                                @else
                                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                        ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                                @endif
                                            @else
                                                <!-- If no data found for last 30 days, show 0 or handle appropriately -->
                                                <span class="badge bg-secondary me-1"><i class="ri-arrow-up-line"></i>
                                                    ৳0</span>
                                            @endif
                                            <span>Since last 30 days</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if($expenses->count() > 10) <!-- যদি 10 টির বেশি আইটেম থাকে -->
                    <div class="card-body p-0">
                        <div class="bg-light-subtle border-top border-bottom border-light">
                            <div class="row text-center">
                                @foreach ($expenses->skip(10)->take(5) as $expense) <!-- ৬ম থেকে ১০ম আইটেম -->
                                    <div class="col">
                                        <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                            {{ $expense->expenseHead->expense_head_name }}
                                        </p>
                                        <h3 class="fw-normal mb-3">
                                            <span>৳{{ number_format($expense->total_amount) }}</span>
                                        </h3>
                                        <p class="mb-0 text-muted text-truncate mb-3">
                                            @php
                                                // Find the matching expense for the last 30 days
                                                $last30DaysExpense = $expensesLast30Days->firstWhere('expense_head_id', $expense->expenseHead->id);
                                            @endphp
                                            @if ($last30DaysExpense)
                                                @if ($last30DaysExpense->total_amount < 0)
                                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                        ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                                @else
                                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                        ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                                @endif
                                            @else
                                                <!-- If no data found for last 30 days, show 0 or handle appropriately -->
                                                <span class="badge bg-secondary me-1"><i class="ri-arrow-up-line"></i>
                                                    ৳0</span>
                                            @endif
                                            <span>Since last 30 days</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($expenses->count() > 15) <!-- যদি ১০টির বেশি আইটেম থাকে -->
                    <div class="card-body p-0">
                        <div class="bg-light-subtle border-top border-bottom border-light">
                            <div class="row text-center">
                                @foreach ($expenses->skip(15)->take(5) as $expense) <!-- ৬ম থেকে ১০ম আইটেম -->
                                    <div class="col">
                                        <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                            {{ $expense->expenseHead->expense_head_name }}
                                        </p>
                                        <h3 class="fw-normal mb-3">
                                            <span>৳{{ number_format($expense->total_amount) }}</span>
                                        </h3>
                                        <p class="mb-0 text-muted text-truncate mb-3">
                                            @php
                                                // Find the matching expense for the last 30 days
                                                $last30DaysExpense = $expensesLast30Days->firstWhere('expense_head_id', $expense->expenseHead->id);
                                            @endphp
                                            @if ($last30DaysExpense)
                                                @if ($last30DaysExpense->total_amount < 0)
                                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                        ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                                @else
                                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                        ৳{{ number_format($last30DaysExpense->total_amount) }}</span>
                                                @endif
                                            @else
                                                <!-- If no data found for last 30 days, show 0 or handle appropriately -->
                                                <span class="badge bg-secondary me-1"><i class="ri-arrow-up-line"></i>
                                                    ৳0</span>
                                            @endif
                                            <span>Since last 30 days</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif



            </div>
        </div>

    </div>
    <div class="row">
        {{-- <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Monthly Present Student</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success">View All <i
                            class="ri-download-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Sreni</th>
                                    <th>Visits</th>
                                    <th style="width: 40%;">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Direct</td>
                                    <td>2,050</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 65%;"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Organic Search</td>
                                    <td>1,405</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 45%;"
                                                aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Refferal</td>
                                    <td>750</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social</td>
                                    <td>540</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>8,965</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col--> --}}
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Complaints</h4>
                    <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-success">View All <i
                            class="ri-eye-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints->take(5) as $complaint)
                                    <tr>
                                        <td>{{ $complaint->name }}</td>
                                        <td>{{ $complaint->number }}</td>
                                        <td>{{ \Str::limit($complaint->description, 15) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->



        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Notices</h4>
                    <a href="{{ route('notices.list') }}" class="btn btn-sm btn-success">View All <i
                            class="ri-eye-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notices->take(5) as $notice)
                                    <tr>
                                        <td>{{ $notice->date }}</td>
                                        <td>{{ \Str::limit($notice->section_title, 15) }}</td>
                                        <!-- Limit to 100 characters -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


        {{-- <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Engagement Overview</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
                            class="ri-download-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Duration (Secs)</th>
                                    <th style="width: 30%;">Sessions</th>
                                    <th style="width: 30%;">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0-30</td>
                                    <td>2,250</td>
                                    <td>4,250</td>
                                </tr>
                                <tr>
                                    <td>31-60</td>
                                    <td>1,501</td>
                                    <td>2,050</td>
                                </tr>
                                <tr>
                                    <td>61-120</td>
                                    <td>750</td>
                                    <td>1,600</td>
                                </tr>
                                <tr>
                                    <td>121-240</td>
                                    <td>540</td>
                                    <td>1,040</td>
                                </tr>
                                <tr>
                                    <td>141-420</td>
                                    <td>56</td>
                                    <td>886</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col--> --}}

    </div>
    @endcan


    {{-- <div class="row row-cols-1 row-cols-xxl-6 row-cols-lg-3 row-cols-md-2">
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Customers">Total Students</h5>
                            <h3 class="my-3">54,214</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                    2,541</span>
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-group-line"></i>
                            </span>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Orders">
                                Orders</h5>
                            <h3 class="my-3">7,543</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                    1.08%</span>
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-shopping-basket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Revenue">
                                Revenue</h5>
                            <h3 class="my-3">$9,254</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                    7.00%</span>
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-money-dollar-circle-line"></i>
                            </span>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Growth">Growth
                            </h5>
                            <h3 class="my-3">+ 20.6%</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                    4.87%</span>
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-donut-chart-line"></i>
                            </span>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">Conversation</h5>
                            <h3 class="my-3">9.62%</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                    3.07%</span>
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar">
                                <i class="ri-pulse-line"></i>
                            </span>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">Balance</h5>
                            <h3 class="my-3">$168.5k</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                    18.34%</span>
                                <span>Since last month</span>
                            </p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-dark rounded rounded-3 fs-3 widget-icon-box-avatar">
                                <i class="ri-wallet-3-line"></i>
                            </span>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row --> --}}

    {{-- <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Total Sales</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div id="average-sales" class="apex-charts mb-3 mt-n5" data-colors="#4254ba">
                    </div>

                    <h5 class="mb-1 mt-0 fw-normal">Brooklyn, New York</h5>
                    <div class="progress-w-percent">
                        <span class="progress-value fw-bold">72k </span>
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 72%;" aria-valuenow="72"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <h5 class="mb-1 mt-0 fw-normal">The Castro, San Francisco</h5>
                    <div class="progress-w-percent">
                        <span class="progress-value fw-bold">39k </span>
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <h5 class="mb-1 mt-0 fw-normal">Kovan, Singapore</h5>
                    <div class="progress-w-percent mb-0">
                        <span class="progress-value fw-bold">61k </span>
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-lg-8">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Revenue</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="bg-light-subtle border-top border-bottom border-light">
                        <div class="row text-center">
                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Current
                                    Week</p>
                                <h3 class="fw-normal mb-3">
                                    <span>$1705.54</span>
                                </h3>
                            </div>
                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                    Previous Week</p>
                                <h3 class="fw-normal mb-3">
                                    <span>$6,523.25 <i class="ri-corner-right-up-fill text-success"></i></span>
                                </h3>
                            </div>
                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                    Conversation</p>
                                <h3 class="fw-normal mb-3">
                                    <span>8.27%</span>
                                </h3>
                            </div>
                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
                                    Customers</p>
                                <h3 class="fw-normal mb-3">
                                    <span>69k <i class="ri-corner-right-down-line text-danger"></i></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div dir="ltr">
                        <div id="revenue-chart" class="apex-charts mt-1" data-colors="#4254ba,#17a497"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> --}}
    <!-- end row -->

    {{-- <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Revenue By Locations</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div id="world-map-markers" class="mt-3 mb-3" style="height: 317px">
                            </div>
                        </div>
                        <div class="col-lg-4" dir="ltr">
                            <div id="country-chart" class="apex-charts" data-colors="#17a497"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
        <div class="col-xl-5">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Top Selling Products</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-info">Export <i
                            class="ri-download-line ms-1"></i></a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th class="py-1">Product</th>
                                    <th class="py-1">Price</th>
                                    <th class="py-1">Orders</th>
                                    <th class="py-1">Avl. Quantity</th>
                                    <th class="py-1">Seller</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ASOS Ridley High Waist</td>
                                    <td>$79.49</td>
                                    <td>82</td>
                                    <td>8,540</td>
                                    <td>Adidas</td>
                                </tr>
                                <tr>
                                    <td>Marco Lightweight Shirt</td>
                                    <td>$12.5</td>
                                    <td>58</td>
                                    <td>6,320</td>
                                    <td>Puma</td>
                                </tr>
                                <tr>
                                    <td>Half Sleeve Shirt</td>
                                    <td>$9.99</td>
                                    <td>254</td>
                                    <td>10,258</td>
                                    <td>Nike</td>
                                </tr>
                                <tr>
                                    <td>Lightweight Jacket</td>
                                    <td>$69.99</td>
                                    <td>560</td>
                                    <td>1,020</td>
                                    <td>Puma</td>
                                </tr>
                                <tr>
                                    <td>Marco Sport Shoes</td>
                                    <td>$119.99</td>
                                    <td>75</td>
                                    <td>357</td>
                                    <td>Adidas</td>
                                </tr>
                                <tr>
                                    <td>Custom Women's T-shirts</td>
                                    <td>$45.00</td>
                                    <td>85</td>
                                    <td>135</td>
                                    <td>Branded</td>
                                </tr>
                                <tr>
                                    <td>Marco Sport Shoes</td>
                                    <td>$119.99</td>
                                    <td>75</td>
                                    <td>357</td>
                                    <td>Adidas</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="#!" class="text-primary text-decoration-underline fw-bold btn mb-2">View
                            All</a>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row --> --}}

    {{-- <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Channels</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
                            class="ri-download-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Channel</th>
                                    <th>Visits</th>
                                    <th style="width: 40%;">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Direct</td>
                                    <td>2,050</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 65%;"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Organic Search</td>
                                    <td>1,405</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 45%;"
                                                aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Refferal</td>
                                    <td>750</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social</td>
                                    <td>540</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>8,965</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Social Media Traffic</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
                            class="ri-download-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Network</th>
                                    <th>Visits</th>
                                    <th style="width: 40%;">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Facebook</td>
                                    <td>2,250</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 65%"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Instagram</td>
                                    <td>1,501</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 45%"
                                                aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Twitter</td>
                                    <td>750</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 30%"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>LinkedIn</td>
                                    <td>540</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>13,851</td>
                                    <td>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 52%"
                                                aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Engagement Overview</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
                            class="ri-download-line ms-1"></i></a>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>Duration (Secs)</th>
                                    <th style="width: 30%;">Sessions</th>
                                    <th style="width: 30%;">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0-30</td>
                                    <td>2,250</td>
                                    <td>4,250</td>
                                </tr>
                                <tr>
                                    <td>31-60</td>
                                    <td>1,501</td>
                                    <td>2,050</td>
                                </tr>
                                <tr>
                                    <td>61-120</td>
                                    <td>750</td>
                                    <td>1,600</td>
                                </tr>
                                <tr>
                                    <td>121-240</td>
                                    <td>540</td>
                                    <td>1,040</td>
                                </tr>
                                <tr>
                                    <td>141-420</td>
                                    <td>56</td>
                                    <td>886</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div> --}}
    <!-- end row -->
@endsection
