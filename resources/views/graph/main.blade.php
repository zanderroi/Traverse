@extends('components.header')
@section('content')
<div class="flex">
    <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center">Dashboard</h2>
          <ul class="space-y-8 ml-6 pr-2">
            <li class="flex items-center ml-4 pr-2"><i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
            <li class="flex items-center ml-4 pr-2"><i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details">Car Owners</a></li>
            <li class="flex items-center ml-4 pr-2"><i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center ml-4 pr-2"><i class="fa-solid fa-book mr-2"></i><a href="/reservation/details">Bookings</a></li>
            <li class="flex items-center pr-2 {{ Request::is('graph') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;"> 
                <i class="fa-solid fa-chart-line mr-2"></i>
                <a href="/graph" class="{{ Request::is('graph') ? 'text-white' : 'text-gray-300' }}">Graph</a>
            </li>
            {{-- <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="#">Sales</a></li> --}}
          </ul>
        </div>
    </div>
    <div class="w-full px-8 py-4 bg-gray-900">
        <div class="col-md-12">
            <h3>Listed Cars Graph</h3>
            <div class="chart-container">
                <label for="carFilter">Filter:</label>
                <select id="carFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
                <canvas id="carsChart"></canvas>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Bookings Graph</h3>
            <div class="chart-container">
                <label for="bookingFilter">Filter:</label>
                <select id="bookingFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Customers Graph</h3>
            <div class="chart-container">
                <label for="customerFilter">Filter:</label>
                <select id="customerFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
            <option value="month">Month</option>
            </select>
            <canvas id="customersChart"></canvas>
            </div>
            </div>
            <div class="col-md-12">
            <h3>Car Owners Graph</h3>
            <div class="chart-container">
            <label for="carOwnerFilter">Filter:</label>
            <select id="carOwnerFilter">
            <option value="hour">Hour</option>
            <option value="day">Day</option>
            <option value="week">Week</option>
            <option value="month">Month</option>
            </select>
            <canvas id="carOwnersChart"></canvas>
            </div>
            </div>
            </div>
        </div>
            </div>
            @include('components.footer')
@endsection
<style>
    .chart-container {
        background-color: #1a202c;
        padding: 10px;
        margin-bottom: 20px;
    }

    h3 {
        color: #c5ff07;
    }

    canvas {
        background-color: #2d3748;
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

        var carChart = createChart('carsChart', 'Listed Cars', carCounts, 'carFilter', 'Number of Listed Cars');
        var bookingChart = createChart('bookingsChart', 'Bookings', bookingCounts, 'bookingFilter', 'Number of Bookings');
        var customerChart = createChart('customersChart', 'Customers', customerCounts, 'customerFilter', 'Number of Customers');
        var carOwnerChart = createChart('carOwnersChart', 'Car Owners', carOwnerCounts, 'carOwnerFilter', 'Number of Car Owners');

        function createChart(chartId, label, data, filterId, yAxisLabel) {
            var ctx = document.getElementById(chartId).getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date'
                            },
                            time: {
                                unit: 'hour' // Initial filter value set to 'hour'
                            },
                            ticks: {
                                fontColor: 'white'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: yAxisLabel
                            },
                            ticks: {
                                fontColor: 'white'
                            }
                        }
                    }
                }
            });

            var filterSelect = document.getElementById(filterId);
            filterSelect.addEventListener('change', function () {
                var filterValue = filterSelect.value;
                var chartOptions = chart.options;

                if (filterValue === 'hour') {
                    chartOptions.scales.x.time.unit = 'hour';
                } else if (filterValue === 'day') {
                    chartOptions.scales.x.time.unit = 'day';
                } else if (filterValue === 'week') {
                    chartOptions.scales.x.time.unit = 'week';
                } else if (filterValue === 'month') {
                    chartOptions.scales.x.time.unit = 'month';
                }

                chart.update();
            });

            return chart;
        }
        var flashingInterval;
        var isFlashing = false;
        function startFlashing() {
            if (!isFlashing) {
                flashingInterval = setInterval(function () {
                    var color = carChart.options.backgroundColor;
                    carChart.options.backgroundColor = color === 'rgba(75, 192, 192, 0.2)' ? 'rgba(255, 0, 0, 0.2)' : 'rgba(75, 192, 192, 0.2)';
                    carChart.update();
                }, 1000);
                isFlashing = true;
            }
        }
        function stopFlashing() {
            if (isFlashing) {
                clearInterval(flashingInterval);
                isFlashing = false;
                carChart.options.backgroundColor = 'rgba(75, 192, 192, 0.2)';
                carChart.update();
            }
        }
        startFlashing();

        var sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', function () {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
            if (sidebar.classList.contains('hidden')) {
                stopFlashing();
            } else {
                startFlashing();
            }
        });
    });
</script>
