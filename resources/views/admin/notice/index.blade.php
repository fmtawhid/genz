@extends('layouts.admin_master')

@section('content')
<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Notices</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('notices.add') }}" class="btn btn-primary">
                        <i class="ri-add-circle-line"></i> Add Notice
                    </a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Notices Data Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="notice_table" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Section Title</th>
                            <th>Description</th>
                            <th>Date</th>
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
<!-- End Notices Data Table -->


@endsection

@section('scripts')
{{-- <script>
// Show the delete confirmation modal
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        var deleteUrl = this.getAttribute('data-action');
        document.getElementById('deleteForm').action = deleteUrl;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
});
</script> --}}

<script>
    $(document).ready(function() {

        // Initialize DataTable
        $("#notice_table").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('notices.list') }}",
            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                
                {
                    data: "section_title",
                    name: "section_title"
                },
                {
                    data: "description",
                    name: "description"
                },
                {
                    data: "date",
                    name: "date"
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
@endsection