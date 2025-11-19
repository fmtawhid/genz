@extends('layouts.admin_master')

@section('styles')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Payment Report</h4>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Date Filters -->
    <div class="row mb-4">
        <div class="col-md-2">
            <label for="from_date" class="form-label">From Date</label>
            <input type="text" id="from_date" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-2">
            <label for="to_date" class="form-label">To Date</label>
            <input type="text" id="to_date" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-2">
            <label for="purpose_id" class="form-label">Purpose</label>
            <select class="form-control select2" id="purpose_id" name="purpose_id" style="width: 100%;" required>
                <option selected="selected" value="">Select Purpose</option>
                @foreach ($purposes as $p)
                    <option {{ $p->id == old('purpose_id') ? 'selected' : '' }} value="{{ $p->id }}">
                        {{ $p->purpose_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Add this below Purpose Filter -->
        <div class="col-md-2">
            <label for="bibag_id" class="form-label">Bibag</label>
            <select class="form-control select2" id="bibag_id" name="bibag_id" style="width: 100%;">
                <option value="">Select Your Bibag</option>
                @foreach ($bibags as $bibag)
                    <option value="{{ $bibag->id }}">{{ $bibag->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 align-self-end">
            <button id="filter" class="btn btn-success me-2">Filter</button>
            <button id="reset" class="btn btn-secondary me-2">Reset</button>
            <!-- Export Buttons -->
            <a href="#" id="export_excel" class="btn btn-success me-2">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="#" id="export_pdf" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
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
    <!-- End Date Filters -->

    <!-- Create Expense Form -->
    <div class="row mt-3">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Total Payments: <span id="totalAmount">{{ number_format($totalAmount, 2) }} TK</span></h4>
                        </div>
                    </div>

                    <!-- Payments DataTable -->
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
    </div> <!-- end row -->



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
        $("#to_date").flatpickr({
            dateFormat: "d-m-Y"
        })

        $("#from_date").flatpickr({
            dateFormat: "d-m-Y"
        })
    </script>

    <script>
        $(document).ready(function() {
            var table = $("#paymentsTable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('payments.report') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.purpose_id = $('#purpose_id').val();
                        d.bibag_id = $('#bibag_id').val(); // <-- এই লাইন অ্যাড করুন
                        
                    }
                },
                lengthMenu: [
                            [10, 25, 50, 100, -1], // -1 will be used for "All items"
                            [10, 25, 50, 100, "All items"] // The text for "All items"
                        ],
                pageLength: 10, // Default value
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'reciept_no', name: 'reciept_no' },
                    { data: 'date', name: 'date' },
                    { data: 'name', name: 'name' },
                    { data: 'dhakila_number', name: 'dhakila_number' },
                    { data: 'address', name: 'address' },
                    { data: 'purpose', name: 'purpose' },
                    { data: 'amount', name: 'amount' },
                    { data: 'amount_in_words', name: 'amount_in_words' },
                    { data: 'bibag', name: 'bibag' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });

            // Handle Filter Button Click
            $('#filter').click(function() {
                table.draw();
            });

            // Handle Reset Button Click
            $('#reset').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#purpose_id').val('');
                $('#bibag_id').val('').trigger('change'); // <-- এই লাইন অ্যাড করুন
                table.draw();
            });

            // Handle the Draw event (when the table is reloaded with new data)
            table.on('draw', function() {
                var totalAmount = 0;
                table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
                    var data = this.data();
                    // Sum the amount column for the rows that are currently visible
                    totalAmount += parseFloat(data.amount.replace(' TK', '').replace(',', ''));
                });

                // Update the total amount on the page
                $('#totalAmount').text(totalAmount.toFixed(2) + ' TK');
            });

            // Export Excel
            $('#export_excel').click(function(e) {
                e.preventDefault();
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                let purposeId = $('#purpose_id').val();
                let bibagId = $('#bibag_id').val();

                let url = "{{ route('payments.export.excel') }}" +
                        "?from_date=" + fromDate +
                        "&to_date=" + toDate +
                        "&purpose_id=" + purposeId +
                        "&bibag_id=" + bibagId; // <-- bibag_id যোগ
                window.location.href = url;
            });

            // Export PDF
            $('#export_pdf').click(function(e) {
                e.preventDefault();
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                let purposeId = $('#purpose_id').val();
                let bibagId = $('#bibag_id').val();
                // console.log("Bibag ID (Excel):", bibagId);
                let url = "{{ route('payments.export.pdf') }}" +
                        "?from_date=" + fromDate +
                        "&to_date=" + toDate +
                        "&purpose_id=" + purposeId +
                        "&bibag_id=" + bibagId; // <-- bibag_id যোগ
                window.location.href = url;
            });
        });

    </script>
@endsection
