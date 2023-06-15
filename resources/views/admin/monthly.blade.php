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
            margin-bottom: 20px;
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
    <h1>Monthly Report</h1>
    <br>
    <div style="text-align: center;">
        <h2>{{ $currentMonth }} {{ $currentYear }}</h2>
    </div>
    @php
        $weekData = [];
        $week = [];
        $startOfMonth = \Carbon\Carbon::parse($currentYear . '-' . $currentMonth . '-01');
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $currentDate = $startOfMonth->copy()->startOfWeek();

        // Fill in the dates from the previous month
        if ($currentDate->month !== $startOfMonth->month) {
            while ($currentDate < $startOfMonth) {
                $week[] = [
                    'day' => '',
                    'carOwnerCount' => '',
                    'customerCount' => '',
                    'bookingCount' => '',
                    'carCount' => '',
                ];
                $currentDate->addDay();
            }
        }

        while ($currentDate <= $endOfMonth) {
            $day = $currentDate->format('Y-m-d');
            $week[] = [
                'day' => \Carbon\Carbon::parse($day)->format('D - j'),
                'carOwnerCount' => isset($monthData[$day]) ? $monthData[$day]['carOwnerCount'] : '',
                'customerCount' => isset($monthData[$day]) ? $monthData[$day]['customerCount'] : '',
                'bookingCount' => isset($monthData[$day]) ? $monthData[$day]['bookingCount'] : '',
                'carCount' => isset($monthData[$day]) ? $monthData[$day]['carCount'] : '',
            ];

            if ($currentDate->dayOfWeek === 6) {
                $weekData[] = $week;
                $week = [];
            }

            $currentDate->addDay();
        }

        if ($week) {
            // Fill in the remaining days until Saturday
            while ($currentDate->dayOfWeek !== 0) {
                $week[] = [
                    'day' => '',
                    'carOwnerCount' => '',
                    'customerCount' => '',
                    'bookingCount' => '',
                    'carCount' => '',
                ];
                $currentDate->addDay();
            }

            $weekData[] = $week;
        }
    @endphp
    @foreach($weekData as $week)
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    @foreach($week as $dayData)
                        <th>{{ $dayData['day'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Car Owners</td>
                    @foreach($week as $dayData)
                        <td>{{ $dayData['carOwnerCount'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Customers</td>
                    @foreach($week as $dayData)
                        <td>{{ $dayData['customerCount'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Bookings</td>
                    @foreach($week as $dayData)
                        <td>{{ $dayData['bookingCount'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Cars</td>
                    @foreach($week as $dayData)
                        <td>{{ $dayData['carCount'] }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>
