<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your custom PDF styling here */
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            padding: 5px;
            text-align: center;
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Weekly Report</h1>
    <br>
    <div style="text-align: center;">
    @php
    $currentMonth = null;
    $currentYear = null;
@endphp

@foreach($weekData as $day => $count)
    @php
        $date = \Carbon\Carbon::parse($day);
        $month = $date->format('F');
        $year = $date->format('Y');

        if ($currentMonth !== $month || $currentYear !== $year) {
            echo "<h2>{$month} {$year}</h2>";
            $currentMonth = $month;
            $currentYear = $year;
        }
    @endphp
@endforeach
    </div>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                @foreach($weekData as $day => $count)
                    <th>{{ \Carbon\Carbon::parse($day)->format('D - j') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Car Owners</td>
                @foreach($weekData as $day => $count)
                    <td>{{ $count['carOwnerCount'] }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Customers</td>
                @foreach($weekData as $day => $count)
                    <td>{{ $count['customerCount'] }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Bookings</td>
                @foreach($weekData as $day => $count)
                    <td>{{ $count['bookingCount'] }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Cars</td>
                @foreach($weekData as $day => $count)
                    <td>{{ $count['carCount'] }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</body>
</html>
