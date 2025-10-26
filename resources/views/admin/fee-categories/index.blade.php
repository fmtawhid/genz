@extends('layouts.admin_master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Fee Categories</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('fee-categories.create') }}" class="btn btn-primary"> 
                            <i class="ri-add-circle-line"></i> Add New Fee Category
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-striped" id="feeCategoryTable">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Category Name</th>
                                <th>Amount</th>
                                <th>Fee Type</th> <!-- Added Fee Type column (Monthly/Yearly) -->
                                <th>Sreni</th>
                                <th>Bibag</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here by DataTables -->
                        </tbody>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#feeCategoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('fee-categories.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'amount', name: 'amount' },
                    { 
                        data: 'fee_type', 
                        name: 'fee_type',
                        render: function(data, type, row) {
                            // This will show "Monthly" or "Yearly" based on is_recurring value
                            return row.is_recurring ? 'Yearly' : 'Monthly';
                        }
                    },
                    { data: 'sreni_name', name: 'sreni_name' },
                    { data: 'bibag_name', name: 'bibag_name' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection
