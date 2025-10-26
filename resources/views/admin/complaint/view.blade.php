@extends('layouts.admin_master')

@section('content')
<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Complaints </h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('complaints.index') }}" class="btn btn-primary">
                        <i class="ri-add-circle-line"></i> View all Complaints
                    </a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Complaint Details Section -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Complaint Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $complaint->name }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $complaint->number }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $complaint->description }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Complaint Details Section -->


@endsection