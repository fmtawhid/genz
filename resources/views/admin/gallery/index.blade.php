@extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Gallery</h4>
                <ol class="breadcrumb m-0">
                    @can('gallery_add')
                    <li class="breadcrumb-item">
                        <a href="{{ route('gallery.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Gallery
                        </a>
                    </li>
                    @endcan
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
                    <table id="gallery_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Date</th>
                                
                                <th>Actions</th>
                              
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        <!-- Display pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Notices Data Table -->

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You cannot undo this action!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Delete button click event
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Get the gallery ID from data-id attribute
                var galleryId = this.getAttribute('data-id');

                // Set the action of the form to the correct delete URL
                var deleteUrl = '{{ route('gallery.destroy', ':id') }}';
                deleteUrl = deleteUrl.replace(':id', galleryId);

                // Set the action of the form in the modal
                document.getElementById('deleteForm').action = deleteUrl;

                // Show the modal
                $('#deleteModal').modal('show');
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            // Initialize DataTable
            $("#gallery_table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('gallery.list') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "image",
                        name: "image",
                        render: function(data, type, row) {
                            // Check if image exists, else show a placeholder image
                            return data ? '<img src="{{ asset('img/galleries') }}/' + data +
                                '" alt="Profile Image" style="width: 50px; height: 50px; object-fit: cover;">' :
                                '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGhFuhp-J1n_y1pfRjcFoRe_PFPgqXXt4OwafWjwoBuTfIbaRQX0Tt5F4&s" alt="Default Image" style="width: 50px; height: 50px; object-fit: cover;">';
                        }
                    },
                    {
                        data: "note",
                        name: "note"
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
