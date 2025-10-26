<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Teacher Attendance Report</h2>
    <p>Generated: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Teacher Name</th>
                <th>Teacher ID</th>
                <th>Attendance Type</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                <td>{{ $attendance->teacher->name }}</td>
                <td>{{ $attendance->teacher->designation }}</td>
                <td style="color: {{ $attendance->attendanceType->color }};">
                    {{ $attendance->attendanceType->name }}
                </td>
                <td>{{ $attendance->remark }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
