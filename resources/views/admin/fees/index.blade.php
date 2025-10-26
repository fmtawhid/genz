@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Fees List</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fee Type</th>
                                <th>Label</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fees as $fee)
                                <tr>
                                    <td>{{ $fee->fee_type }}</td>
                                    <td>{{ $fee->label }}</td>
                                    <td>{{ $fee->amount }}</td>
                                    <td>
                                        <a href="{{ route('fees.show', $fee->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-success">Create New Fee</a>
                </div>
            </div>
        </div>
    </div>
@endsection
