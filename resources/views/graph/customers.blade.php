@extends('components.header')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Customer Graph</h3>
            <div>
                <label for="filter">Filter:</label>
                <select id="filter">
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>
            </div>
            <canvas id="customersChart"></canvas>
        </div>
        <div class="col-md-6">
            <!-- Other content or sections -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Retrieve the labels and customer counts from the server-side
            var labels = @json($labels);
            var customerCounts = @json($customerCounts);

            // Create the chart using Chart.js
            var ctx = document.getElementById('customersChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line', // Set the chart type to line
                data: {
                    labels: labels, // Set the labels for the x-axis
                    datasets: [{
                        label: 'Customers', // Set the label for the dataset
                        data: customerCounts, // Set the customer counts for the y-axis
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the fill color
                        borderColor: 'rgba(75, 192, 192, 1)', // Customize the line color
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true, // Enable responsiveness
                    scales: {
                        x: {
                            display: true, // Display the x-axis
                            title: {
                                display: true,
                                text: 'Date' // Customize the x-axis label
                            }
                        },
                        y: {
                            display: true, // Display the y-axis
                            title: {
                                display: true,
                                text: 'Number of Customers' // Customize the y-axis label
                            }
                        }
                    }
                }
            });

            // Add event listener for the filter selection
            var filterSelect = document.getElementById('filter');
            filterSelect.addEventListener('change
', function () {
var filterValue = filterSelect.value;

arduino
Copy code
            // Update the chart based on the selected filter
            if (filterValue === 'hour') {
                chart.options.scales.x.time.unit = 'hour';
            } else if (filterValue === 'day') {
                chart.options.scales.x.time.unit = 'day';
            } else if (filterValue === 'week') {
                chart.options.scales.x.time.unit = 'week';
            } else if (filterValue === 'month') {
                chart.options.scales.x.time.unit = 'month';
            }

            chart.update(); // Update the chart to apply the new filter
        });
    });
</script>
@endsection

