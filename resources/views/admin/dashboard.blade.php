{{-- @include('components.header')
<div class="flex">
    <div class="sidebar text-white  w-48 pt-8 pb-8" style="background-color: #0C0C0C; min-height: 100vh;">
    <div class="content-titles mt-1">
      <h2 class="text-xl font-bold mb-4 text-center">Dashboard</h2>
      <ul class="space-y-8 ml-6">
        <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-car-side mr-2"></i><a href="/admin/carapproval"> Car Verification</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details">Car Owners</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i></i><a href="/reservation/details">Bookings</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/admin/sales">Sales</a></li>
      </ul>
    </div>
</div>
<div class="flex flex-row p-8 space-x-4">
    <div class="col-md-4">
        <div class="card bg-black text-white">
            <div class="card-body">
                <h5 class="card-title text-center text-lg">Cars</h5>
                <p class="card-text text-center text-lg">{{ $carsCount }}</p>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="/cars/details" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title text-center text-lg">car owners</h5>
                <p class="card-text text-center text-lg">{{ $carOwners }}</p>   
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="/owners/details" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
                

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title text-center text-lg">Total customers</h5>
                <p class="card-text text-center text-lg">{{ $customers }}</p>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="/customers/details" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title text-center text-lg">Bookings</h5>
                <p class="card-text text-center text-lg">{{ $totalBookings }}</p>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="/reservation/details" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container mx-auto p-4 rounded-lg" style="background-color: #E5E7EB;">
        <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold mb-4">
            Car Owners Weekly Data
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
                    <p class="text-gray-600">Registered Car Owners: {{ $count }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
</html>
@include('components.footer')

 --}}

 @include('components.header')
<div class="flex">
  <div class="sidebar text-white w-48 pt-8 pb-8" style="background-color: #0C0C0C; min-height: 100vh;">
    <div class="content-titles mt-1">
      <h2 class="text-xl font-bold mb-4 text-center">Dashboard</h2>
      <ul class="space-y-8 ml-6">
        <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-car-side mr-2"></i><a href="/admin/carapproval"> Car Verification</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details">Car Owners</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i></i><a href="/reservation/details">Bookings</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/admin/sales">Sales</a></li>
      </ul>
    </div>
  </div>
  <div class="w-full">
  <div class="flex flex-row p-2 space-x-2 mt-2">
    <div class="col-md-3">
      <div class="card bg-black text-white" >
        <div class="card-body">
          <h5 class="card-title text-center text-lg">Cars</h5>
          <p class="card-text text-center text-lg">{{ $carsCount }}</p>
          <hr>
          <div class="d-flex justify-content-center">
            <a href="/cars/details" class="btn btn-outline-light">
              View more details
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-secondary text-white">
        <div class="card-body">
          <h5 class="card-title text-center text-lg">car owners</h5>
          <p class="card-text text-center text-lg">{{ $carOwners }}</p>
          <hr>
          <div class="d-flex justify-content-center">
            <a href="/owners/details" class="btn btn-outline-light">
              View more details
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h5 class="card-title text-center text-lg">Total customers</h5>
          <p class="card-text text-center text-lg">{{ $customers }}</p>
          <hr>
          <div class="d-flex justify-content-center">
            <a href="/customers/details" class="btn btn-outline-light">
              View more details
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h5 class="card-title text-center text-lg">Bookings</h5>
          <p class="card-text text-center text-lg">{{ $totalBookings }}</p>
          <hr>
          <div class="d-flex justify-content-center">
            <a href="/reservation/details" class="btn btn-outline-light">
              View more details
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

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
        <p class="text-gray-600">Car Owners: {{ $count['carOwnerCount'] }}<br>
            Customers: {{ $count['customerCount'] }}<br>
            Bookings: {{ $count['bookingCount'] }}<br>
            Cars: {{ $count['carCount'] }}</p>
      </div>
    @endforeach
  </div>
  <div class="mt-4">
    <form action="{{ route('downloadWeekDataPDF') }}" method="POST">
      @csrf
      <input type="hidden" name="weekData" value="{{ json_encode($weekData) }}">
      <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2.5">Generate Weekly Data</button>
    </form>
  </div>
  <div class="mt-4">
    <form action="{{ route('downloadMonthDataPDF') }}" method="POST">
      @csrf
      <input type="hidden" name="month" value="{{ $selectedMonth }}">
      <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2.5">Generate Monthly Data</button>
    </form>
</div>
</div>
</div>
</div>
@include('components.footer')
</html>
