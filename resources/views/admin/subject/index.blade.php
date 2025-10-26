@extends('layouts.admin_master')

@section('content')
<div class="row mt-3">
    <!-- Create Subject Form -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">Add Subject</h4>
                <form id="createSubjectForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="sreni_id" class="form-label">Class (Sreni)</label>
                        <select class="form-control" id="sreni_id" name="sreni_id" required>
                            <option value="">Select Class</option>
                            @foreach ($srenis as $sreni)
                                <option value="{{ $sreni->id }}">{{ $sreni->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Add Bibag Dropdown -->
                    <div class="mb-3">
                        <label for="bibag_id" class="form-label">Bibag</label>
                        <select class="form-control" id="bibag_id" name="bibag_id" required>
                            <option value="">Select Bibag</option>
                            @foreach ($bibags as $bibag)
                                <option value="{{ $bibag->id }}">{{ $bibag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Subject List -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">Subject List</h4>
                <table class="table table-striped" id="subjectsTable">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Subject Name</th>
                            <th>Class (Sreni)</th>
                            <th>Bibag</th> <!-- Add Bibag column -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated using DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with AJAX data fetching
        var table = $('#subjectsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('subjects.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'sreni.name', name: 'sreni.name' },
                { data: 'bibag.name', name: 'bibag.name' },  <!-- Add Bibag column in the DataTable -->
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });

        // Handle form submission for adding a new subject
        $('#createSubjectForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route('subjects.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response.success);
                    table.ajax.reload();  // Reload the DataTable with new data
                    $('#createSubjectForm')[0].reset();  // Reset the form
                },
                error: function(xhr) {
                    alert('Error while submitting the form');
                }
            });
        });

        // Handle subject deletion via AJAX
        $(document).on('click', '.deleteSubject', function() {
            var subjectId = $(this).data('id');
            var row = $(this).closest('tr');

            if (confirm('Are you sure you want to delete this subject?')) {
                $.ajax({
                    url: '/admin/subjects/' + subjectId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert(response.success);
                        table.row(row).remove().draw();  // Remove the row from the table
                    },
                    error: function(xhr) {
                        alert('Error while deleting the subject');
                    }
                });
            }
        });
    });
</script>
@endsection
