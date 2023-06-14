@include('components.header')
@section('content')
<div class="flex">
    <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C; min-height: 100vh;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center {{ Request::is('admin/verification') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;"> 
                <i class="fa-solid fa-user-shield mr-2"></i>
                <a href="/admin/verification" class="{{ Request::is('admin/verification') ? 'text-white' : 'text-gray-300' }}"> Account Verification</a>
            </li>
            <li class="flex items-center {{ Request::is('admin/carapproval') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;"> 
                <i class="fa-solid fa-car-side mr-2"></i>
                <a href="/admin/carapproval" class="{{ Request::is('admin/carapproval') ? 'text-white' : 'text-gray-300' }}"> Car Verification</a>
            </li>
            <li class="flex items-center ml-4"><i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details"> Car Owners</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i><a href="/reservation/details">Bookings</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
            <li class="flex items-center {{ Request::is('admin/sales') ? 'bg-indigo-600' : '' }} w-full "style="padding: 12px 16px; height: 48px;"> <i class="fa-solid fa-peso-sign mr-2"></i>
                <a class="{{ Request::is('admin/sales') ? 'text-white' : 'text-gray-300' }}" href="/admin/sales">Sales</a></li>
          </ul>
        </div>
    </div>

    <div class="p-5">
        <div class="flex flex-row">
            <div>
                <h1 class="text-md font-bold text-4xl ml-4">Overview</h1>
            </div>
            <div class="flex items-end ml-auto mr-4">
                <form action="{{ route('admin.sales') }}" method="GET" id="sales-filter-form" class="flex">
                    <select name="filter_type" id="filter_type" class="mr-1 bg-white border border-gray-300 rounded px-4 py-2 shadow-md">
                        <option value="timeframe">Timeframe</option>
                        <option value="custom">Custom Dates</option>
                    </select>
            
                    <div id="timeframe-filter" class="filter-section">
                        <select name="timeframe" id="timeframe" class="bg-white border border-gray-300 rounded shadow-md px-4 py-2">
                            <option value="yearly" {{ $timeframe === 'yearly' ? 'selected' : '' }}>Current Year</option>
                            <option value="weekly" {{ $timeframe === 'weekly' ? 'selected' : '' }}>Current Week</option>
                            <option value="monthly" {{ $timeframe === 'monthly' ? 'selected' : '' }}>Current Month</option>
                        </select>
                    </div>
                    
            
                    <div id="custom-filter" class="filter-section" style="display: none;">
                        <label for="start_date" class="mr-2">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="bg-white border border-gray-300 rounded px-4 py-2">
                        <label for="end_date" class="ml-4 mr-2">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="bg-white border border-gray-300 rounded px-4 py-2">
                    </div>
            
                    <button type="submit" class="ml-1 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md">Filter</button>
                </form>
            </div>
            
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const filterTypeSelect = document.getElementById('filter_type');
                    const timeframeFilter = document.getElementById('timeframe-filter');
                    const customFilter = document.getElementById('custom-filter');
                    
                    filterTypeSelect.addEventListener('change', function() {
                        if (this.value === 'timeframe') {
                            timeframeFilter.style.display = 'block';
                            customFilter.style.display = 'none';
                        } else if (this.value === 'custom') {
                            timeframeFilter.style.display = 'none';
                            customFilter.style.display = 'block';
                        }
                    });
                });
            </script>
            
        </div>
        
        <div class=" flex flex-row space-x-4" >
        <div class="flex flex-row space-x-4">
        <div class="mt-4 h-28 rounded-lg shadow-md p-6 flex items-center justify-center " style="background-color: rgb(36, 36, 36);">
            <div class="flex items-center justify-between">
              <div class="text-white text-xl font-bold mr-2">Total Sales</div>
              <div class="bg-indigo-500 text-white rounded-lg px-4 py-2">
                <i class="fa-solid fa-peso-sign mr-2"></i>{{number_format($totalSales,2)}}
              </div>
            </div>
          </div>

          <div class="mt-4 h-28 rounded-lg shadow-md p-6 flex items-center justify-center" style="background-color: rgb(36, 36, 36);">
            <div class="flex items-center justify-between">
              <div class="text-xl font-bold mr-2 text-white">Total Profit</div>
              <div class="bg-indigo-500 text-white rounded-lg px-4 py-2">
                <i class="fa-solid fa-peso-sign mr-2"></i>{{ number_format($totalCommission,2) }}
              </div>
            </div>
          </div>

          <div class="mt-4 h-28 rounded-lg shadow-md p-6 flex items-center justify-center" style="background-color: rgb(36, 36, 36);">
            <div class="text-white text-xl font-bold mr-2">Total Bookings</div>
            <div class="bg-indigo-500 text-white rounded-lg px-4 py-2">
              {{$totalBookings}}
            </div>
          </div>
        <!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div id="sales-graph"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch sales data for the graph
        fetchSalesData();

        // Function to fetch sales data and update the graph
        function fetchSalesData() {
            const timeframe = document.getElementById('timeframe').value;
            const url = "{{ route('admin.sales.data') }}?timeframe=" + timeframe;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    createSalesGraph(data.labels, data.values);
                })
                .catch(error => {
                    console.log(error);
                });
        }

        // Function to create the sales graph
        function createSalesGraph(labels, values) {
            const salesGraphCanvas = document.getElementById('sales-graph');

            new Chart(salesGraphCanvas, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Sales',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
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
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Sales'
                            }
                        }
                    }
                }
            });
        }

        // Event listener for timeframe selection change
        const timeframeSelect = document.getElementById('timeframe');
        timeframeSelect.addEventListener('change', function() {
            fetchSalesData();
        });
    });
</script>

        </div>
        
<div class="mt-4 h-96  rounded-lg shadow-md p-6" style="width: 250px; background-color: rgb(36, 36, 36);">
    <div class="text-white text-xl font-bold mr-2 flex justify-center items-center">Top Car Owner</div>
    @if ($latestProfilePicture)
    <img class="mt-4 p-1 w-30 h-30 rounded-full mx-auto border-2 border-blue-700" src="{{ asset('storage/' . $latestProfilePicture->profilepicture) }}" alt="Profile Picture">
    @else
        <img class="mt-4 p-4 w-30 h-30 rounded-full mx-auto border-2 border-blue-700" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
    @endif

    <p class="text-lg font-semibold text-blue-600 text-center mt-2 ">{{ $topCarOwner->first_name }} {{ $topCarOwner->last_name }} </p>
    <div class="bg-indigo-500 text-white rounded-lg px-4 py-2 items-center text-center">
        <i class="fa-solid fa-peso-sign mr-2"></i>{{ number_format($topCarOwnerTotalSales,2) }}
    </div>
    
</div>



        </div>
    </div>
        