@extends('components.header')
@section('content')
    <div class="flex">
        <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C;">
            <div class="content-titles mt-1">
                <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
                <ul class="space-y-8 ml-6 pr-2">
                    <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
                    <li class="flex items-center ml-4"> <i class="fa-solid fa-car-side mr-2"></i><a href="/admin/carapproval"> Car Verification</a></li>
                    <li class="flex items-center ml-4 pr-2">
                        <i class="fa-solid fa-car mr-2"></i>
                        <a href="/cars/details">Cars</a>
                    </li>
                    <li class="flex items-center ml-4 pr-2">
                        <i class="fa-solid fa-user-group mr-2"></i>
                        <a href="/owners/details">Car Owners</a>
                    </li>
                    <li class="flex items-center ml-4 pr-2">
                        <i class="fa-solid fa-briefcase mr-2"></i>
                        <a href="/customers/details">Customers</a>
                    </li>
                    <li class="flex items-center ml-4 pr-2">
                        <i class="fa-solid fa-book mr-2"></i>
                        <a href="/reservation/details">Bookings</a>
                    </li>
                    <li class="flex items-center pr-2 {{ Request::is('graph') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;">
                        <i class="fa-solid fa-chart-line mr-2"></i>
                        <a href="/graph" class="{{ Request::is('graph') ? 'text-white' : 'text-gray-300' }}">Graph</a>
                    </li>
                    <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/admin/sales">Sales</a></li>
                </ul>
            </div>
        </div>
        <div class="w-full px-8 py-4 bg-gray-900">
            <br>
            <div class="col-md-12 text-center">
                <h3 class="text-3xl font-bold mb-4">Graphical Data</h3>
                <div class="chart-container">
                    <canvas id="combinedChart"></canvas>
                </div>
            </div>
            {{-- <div class="container mx-auto p-4 rounded-lg" style="background-color: #E5E7EB;">

                <h1 class="text-2xl font-bold mb-4">Car Owners registered this week <br>
                    {{ Carbon\Carbon::now()->startOfWeek(Carbon\Carbon::SUNDAY)->format('Y, F j') }} - {{ Carbon\Carbon::now()->endOfWeek(Carbon\Carbon::SATURDAY)->format('F j') }}
                </h1>
                <div class="grid grid-cols-7 gap-4">
                    @foreach($weekData as $day => $count)
                        <div class="p-4 bg-gray-100 rounded">
                            <h2 class="text-lg font-bold">{{ Carbon\Carbon::parse($day)->format('D - j') }}</h2>
                            <p class="text-gray-600">Registered Car Owners: {{ $count }}</p>
                        </div>
                    @endforeach
                </div>
            </div> --}}

            <div class="container mx-auto p-4 rounded-lg" style="background-color: #E5E7EB;">
                <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold mb-4">
                    Weekly Data
                    @if (isset($selectedMonth) && isset($selectedWeek))
                    ({{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }}, Week {{ $selectedWeek }})
                    @endif
                </h1>
                <form id="filter-form" class="mb-4 flex items-end">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="month" class="block font-bold mb-1">Select Month:</label>
                            <select name="month" id="month" class="border border-gray-300 rounded p-2">
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="week" class="block font-bold mb-1">Select Week:</label>
                            <select name="week" id="week" class="border border-gray-300 rounded p-2">
                                @foreach ($weeks as $week)
                                    <option value="{{ $week['week'] }}" {{ $selectedWeek == $week['week'] ? 'selected' : '' }}>
                                        {{ $week['week'] }}{{ $week['week'] == 1 ? 'st' : ($week['week'] == 2 ? 'nd' : ($week['week'] == 3 ? 'rd' : 'th')) }} week
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2.5">Apply Filter</button>
                </form>
            </div>
                <div class="grid grid-cols-7 gap-4">
                    @foreach($weekData as $day => $count)
                        <div class="p-4 bg-gray-100 rounded">
                            <h2 class="text-lg font-bold">{{ Carbon\Carbon::parse($day)->format('D - j') }}</h2>
                            <p class="text-gray-600">Registered</p>
                            <p class="text-gray-600">Car Owners: {{ $count['carOwnerCount'] }}<br>
                                Customers: {{ $count['customerCount'] }}<br>
                                Bookings: {{ $count['bookingCount'] }}<br>
                                Cars: {{ $count['carCount'] }}</p>
                          </div>
                    @endforeach
                </div>
            </div>
           
            
        </div>
    </div>
   

    @include('components.footer')
@endsection

<style>
    .chart-container {
        background-color: #1a202c;
        padding: 20px;
        margin-bottom: 40px;
        margin-left: auto;
        margin-right: auto;
        max-width: 800px; /* Adjust the max-width here */
    }

    h3 {
        color: skyblue;
        margin-bottom: 20px;
    }

    canvas {
        background-color: #2d3748;
        width: 100%;
        height: auto;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var labels = @json($labels);
        var carCounts = @json($carCounts);
        var bookingCounts = @json($bookingCounts);
        var customerCounts = @json($customerCounts);
        var carOwnerCounts = @json($carOwnerCounts);

        createCombinedChart(labels, carCounts, bookingCounts, customerCounts, carOwnerCounts);

        function createCombinedChart(labels, carCounts, bookingCounts, customerCounts, carOwnerCounts) {
            var ctx = document.getElementById('combinedChart').getContext('2d');
            var combinedChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Listed Cars',
                            data: carCounts,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2
                        },
                        {
                            label: 'Bookings',
                            data: bookingCounts,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2
                        },
                        {
                            label: 'Customers',
                            data: customerCounts,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 2
                        },
                        {
                            label: 'Car Owners',
                            data: carOwnerCounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date',
                                color: 'rgba(209, 213, 219, 1)' // Gray-300
                            },
                            ticks: {
                                color: 'rgba(209, 213, 219, 1)' // Gray-300
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Number of',
                                color: 'rgba(209, 213, 219, 1)' // Gray-300
                            },
                            ticks: {
                                beginAtZero: true,
                                precision: 0,
                                color: 'rgba(209, 213, 219, 1)' // Gray-300
                            }
                        }
                    }
                }
            });
        }

        var sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', function () {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
        });
    });
</script>