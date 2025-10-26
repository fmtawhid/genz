@extends('layouts.admin_master')

@section('content')
<div class="card">
    <div class="card-header">
        Results for {{ $exam->name }} - {{ $student->name }}
    </div>
    <div class="card-body">
        @if ($results->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->subject->name }}</td>  <!-- Assuming you have a 'subject' relationship -->
                            <td>{{ $result->marks }}</td>         <!-- Assuming you have a 'marks' column in the 'results' table -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No results available for this exam.</p>
        @endif
    </div>
</div>
@endsection
