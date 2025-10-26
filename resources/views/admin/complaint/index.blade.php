@extends('layouts.admin_master')

@section('content')
<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Complaints</h4>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Success Message -->
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Complaints Data Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="complaint_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Description</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $complaint)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $complaint->name }}</td>
                                <td>{{ $complaint->number }}</td>
                                <td>{{ Str::limit($complaint->description, 20) }}</td>

                                <td>
                                    <a href="{{ route('complaints.show', $complaint->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="ri-eye-line"></i> View

                                    </a>
                                    @can('complaint_delete')
                                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete">
                                            <i class="ri-delete-bin-line"></i> Delete
                                        </button>
                                    </form>
                                    @endcan
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Complaints Data Table -->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $("#complaint_table").DataTable({
        language: {
            emptyTable: "No complaints available.",
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            zeroRecords: "No matching records found",
        },
    });

    // // Handle delete button with confirmation modal
    // $(document).on("click", ".delete", function(e) {
    //     e.preventDefault();
    //     let form = $(this).closest("form");

    //     if (confirm("Are you sure you want to delete this complaint? This action cannot be undone.")) {
    //         form.submit();
    //     }
    // });

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
});
</script>
@endsection