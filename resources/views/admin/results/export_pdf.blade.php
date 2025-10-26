<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .filters {
            margin-bottom: 10px;
            font-size: 13px;
        }

        .date-row {
            margin-bottom: 10px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="heading">Exam Results{{ $subjectName ? ' - ' . $subjectName : '' }}</h2>

        {{-- Filter Information --}}
        <div class="filters">
            <strong>Filters:</strong>
            @php
                $examName = $exams->where('id', $examId)->first()->name ?? 'All';
                $className = $srenis->where('id', $sreniId)->first()->name ?? 'All';
                $groupName = $bibags->where('id', $bibagId)->first()->name ?? 'All';
                $subjectNameShow = $subjects->where('id', $subjectId)->first()->name ?? 'All';
            @endphp
            | <strong>Exam:</strong> {{ $examName }}
            | <strong>Class:</strong> {{ $className }}
            | <strong>Group:</strong> {{ $groupName }}
            | <strong>Subject:</strong> {{ $subjectNameShow }}
        </div>
        <div class="date-row">
            <strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Roll Number</th>
                    <th>
                        {{ $subjectId ? 'Marks' : 'Total Marks' }}
                    </th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sortedStudents = $students->sortByDesc($subjectId ? 'marks' : 'total_marks')->values();
                    $rank = 1;
                @endphp
                @foreach($sortedStudents as $index => $student)
                    <tr>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->roll_number }}</td>
                        <td>
                            {{ $subjectId ? ($student->marks ?? 0) : ($student->total_marks ?? 0) }}
                        </td>
                        <td>
                            @if($rank <= 3)
                                {{ $rank }}{{ $rank == 1 ? 'st' : ($rank == 2 ? 'nd' : 'rd') }}
                                @php $rank++; @endphp
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- <tbody>
                @php
                    // সাবজেক্ট সিলেক্ট থাকলে marks, না থাকলে total_marks দিয়ে sort হবে
                    $sortedStudents = $students->sortByDesc($subjectId ? 'marks' : 'total_marks')->values();
                    $rank = 1;
                @endphp
                @foreach($sortedStudents as $index => $student)
                    <tr>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->roll_number }}</td>
                        <td>
                            {{ $subjectId ? ($student->marks ?? 0) : ($student->total_marks ?? 0) }}
                        </td>
                        <td>
                            @if (
                                    $index > 0 &&
                                    (
                                        ($subjectId && $student->marks == $sortedStudents[$index - 1]->marks) ||
                                        (!$subjectId && $student->total_marks == $sortedStudents[$index - 1]->total_marks)
                                    )
                                )
                                {{ $rank }}th
                            @else
                                {{ $rank++ }}th
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody> -->
        </table>
    </div>
</body>

</html>