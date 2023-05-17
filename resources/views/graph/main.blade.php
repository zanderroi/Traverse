@extends('components.header')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Listed Cars Graph</h3>
            <div>
                <label for="carFilter">Filter:</label>
                <select id="carFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
            </div>
            <canvas id="carsChart"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Bookings Graph</h3>
            <div>
                <label for="bookingFilter">Filter:</label>
                <select id="bookingFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
            </div>
            <canvas id="bookingsChart"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Customers Graph</h3>
            <div>
                <label for="customerFilter">Filter:</label>
                <select id="customerFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
            </div>
            <canvas id="customersChart"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Car Owners Graph</h3>
            <div>
                <label for="carOwnerFilter">Filter:</label>
                <select id="carOwnerFilter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
            </div>
            <canvas id="carOwnersChart"></canvas>
        </div>
    </div>


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
        var flashingColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 0, 0, 0.2)', 'rgba(0, 255, 0, 0.2)', 'rgba(0, 0, 255, 0.2)'];

        function startFlashing() {
            if (!isFlashing) {
                isFlashing = true;
                var index = 0;
                flashingInterval = setInterval(function () {
                    carChart.data.datasets[0].backgroundColor = flashingColors[index];
                    bookingChart.data.datasets[0].backgroundColor = flashingColors[index];
                    customerChart.data.datasets[0].backgroundColor = flashingColors[index];
                    carOwnerChart.data.datasets[0].backgroundColor = flashingColors[index];
                    carChart.update();
                    bookingChart.update();
                    customerChart.update();
                    carOwnerChart.update();
                    index = (index + 1) % flashingColors.length;
                }, 500);
            }
        }

        function stopFlashing() {
            if (isFlashing) {
                isFlashing = false;
                clearInterval(flashingInterval);
                carChart.data.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.2)';
                bookingChart.data.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.2)';
                customerChart.data.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.2)';
                carOwnerChart.data.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.2)';
                carChart.update();
                bookingChart.update();
                customerChart.update();
                carOwnerChart.update();
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'f') {
                startFlashing();
            }
        });

        document.addEventListener('keyup', function (event) {
            if (event.key === 'f') {
                stopFlashing();
            }
        });

        
    });
    
</script>
<style>
   
    body {
    background-color: #111;
    color: white;
    }
    </style>

@endsection