@extends('layouts.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between align-items-center">
            <h4 class="page-title">Courses</h4>
            @can('course_add')
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
            @endcan
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="course_table" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Teachers</th>
                            <th>Topics</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('#course_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('courses.index') }}",
        columns: [
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'image', name:'image', orderable:false, searchable:false},
            {data:'title', name:'title'},
            {data:'teachers', name:'teachers', orderable:false, searchable:false},
            {data:'topics', name:'topics', orderable:false, searchable:false},
            {data:'price', name:'price'},
            {data:'duration', name:'duration'},
            {data:'actions', name:'actions', orderable:false, searchable:false},
        ]
    });
});
</script>
@endsection
