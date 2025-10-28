<!DOCTYPE html>
<html>

<head>
    <title>Students Report</title>
    <style>
        /* Add any custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Gen-Z IT Institute</h2>
    <h2>Expense Report</h2>
    <p>From Date: {{ $fromDate ?? 'N/A' }}</p>
    <p>To Date: {{ $toDate ?? 'N/A' }}</p>
    <table>
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Expense Head</th>
                <th>Name</th>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $index => $expense)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $expense->expense_head_name }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->invoice_no }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->amount }} TK</td>
                    <td>{{ $expense->note }}</td>
                    <td>{{ $expense->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
