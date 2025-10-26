@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12 mt-2">
            <h4>Due Fees for Students</h4>

            <!-- Filter Form -->
            <div class="row my-3">
                <div class="col-md-3">
                    <label for="sreni_id" class="form-label">Class</label>
                    <select class="form-control select2" id="sreni_id">
                        <option value="">Select Class</option>
                        @foreach ($srenis as $sreni)
                            <option value="{{ $sreni->id }}">{{ $sreni->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="bibag_id" class="form-label">Bibhag</label>
                    <select class="form-control select2" id="bibag_id">
                        <option value="">Select Bibhag</option>
                        @foreach ($bibags as $bibag)
                            <option value="{{ $bibag->id }}">{{ $bibag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 align-self-end">
                    <button id="filter" class="btn btn-success me-2">Filter</button>
                    <button id="reset" class="btn btn-secondary me-2">Reset</button>
                </div>
            </div>

            <!-- DataTable for Students -->
            <div class="card">
                <div class="card-body">
                    <table id="product" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Bibhag</th>
                                <th>Total Due</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- The table body will be populated with AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            // Initialize DataTable
            var table = $("#product").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('students.due') }}",
                    data: function (d) {
                        d.sreni_id = $('#sreni_id').val(); // Get the selected class filter
                        d.bibag_id = $('#bibag_id').val(); // Get the selected bibhag filter
                        d.search = $('#product_filter').val(); // Include the search term (optional)
                    }
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "student_name", name: "student_name", searchable: true },
                    { data: "sreni_name", name: "sreni_name" },
                    { data: "bibag_name", name: "bibag_name" },
                    { data: "total_due_after_payment", name: "total_due_after_payment" },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<button class="btn btn-info btn-sm view-details" data-id="${row.id}">View Details</button>`;
                        }
                    }
                ]
            });

            // Filter button click
            $('#filter').click(function () {
                table.draw(); // Redraw the table with new filter data
            });

            // Reset button click
            $('#reset').click(function () {
                $('#sreni_id').val('');
                $('#bibag_id').val('');
                table.draw(); // Redraw the table without filters
            });

            // View details button click
            $(document).on('click', '.view-details', function () {
                let studentId = $(this).data('id');
                window.location.href = "{{ url('panel/students/due') }}/" + studentId; // Redirect to the student details page
            });
        });
    </script>
@endsection
