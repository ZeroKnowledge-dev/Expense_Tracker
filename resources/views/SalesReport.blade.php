<html>

<head>
    <style>
        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px !important;
        }

        .customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .customers tr:hover {
            background-color: #ddd;
        }

        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 6px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h3>Summary</h3>

    <table class="customers">
        <thead>
            <tr>
                <th>Report</th>
                <th>Date</th>
                <th>Total Deposits</th>
                <th>Total Withdrawals</th>
                <th>Balance Left</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sales Report</td>
                <td>{{$FromDate}} to {{$ToDate}}</td>
                <td>{{$totalDeposits}}</td>
                <td>{{$totalWithdrawals}}</td>
                <td>{{$balanceLeft}}</td>
            </tr>
        </tbody>
    </table>

    <h3>Details</h3>
    <table class="customers">
        <thead>
            <tr>
                <th>Date</th>
                <th>Task Names</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Group the tasks by date
                $groupedTasks = $list->groupBy(function ($item) {
                    return \Carbon\Carbon::parse($item->date)->format('D, d, Y');
                });
            @endphp

            @foreach ($groupedTasks as $date => $tasks)
                <tr>
                    <td>{{ $date }}</td> <!-- rowspan for all tasks on the same date -->
                    <td>
                        @foreach ($tasks as $task)
                            {{ $task->name }} - {{ $task->amount }}<br> <!-- List task name and amount -->
                        @endforeach
                    </td>
                    <td>
                        @foreach ($tasks as $task)
                            {{ $task->type }}<br> <!-- List task type -->
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
