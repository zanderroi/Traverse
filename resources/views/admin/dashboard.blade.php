@include('components.header')
<div class="flex">
    <div class="sidebar text-white  w-48 pt-8 pb-8" style="background-color: #0C0C0C; min-height: 100vh;">
    <div class="content-titles mt-1">
      <h2 class="text-xl font-bold mb-4 text-center">Dashboard</h2>
      <ul class="space-y-8 ml-6">
        <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details">Car Owners</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i></i><a href="/reservation/details">Bookings</a></li>
        <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
        {{-- <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/graph/details">Sales</a></li> --}}
      </ul>
    </div>
</div>
<div class="flex flex-row p-8 space-x-4">
    <div class="col-md-4">
        <div class="card bg-black text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Cars</h5>
                <p class="card-text text-center">{{ $carsCount }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>Booked</td>
                        <td> {{ $bookedCarsCount }} </td>
                    </tr>
                    <tr>
                        <td>Available</td>
                        <td> {{ $availableCarsCount }} </td>
                    </tr>
                </table>
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
                <h5 class="card-title text-center">Total car owners</h5>
                <p class="card-text text-center">{{ $carOwners }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>On Transanctions</td>
                        <td> {{ $carOwnersOnTransactions }} </td>
                    </tr>
                    <tr>
                        <td>Vacant</td>
                        <td> {{ $carOwnersVacant }} </td>
                    </tr>
                </table>
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
                <h5 class="card-title text-center">Total customers</h5>
                <p class="card-text text-center">{{ $customers }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>On Transactions</td>
                        <td> {{ $customersOnTransactions }} </td>
                    </tr>
                    <tr>
                        <td>Vacant</td>
                        <td> {{ $customersVacant }} </td>
                    </tr>
                </table>
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
                <h5 class="card-title text-center">Bookings</h5>
                <p class="card-text text-center">{{ $totalBookings }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>Done</td>
                        <td>{{ $bookingsDone }}</td>
                    </tr>
                    <tr>
                        <td>On Going</td>
                        <td>{{ $bookingsOngoing }}</td>
                    </tr>
                </table>
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
    <div class="flex flex-col p-8 space-x-4">
        <table class="table mt-4 pt-4">
          <thead>
            <tr>
              <th></th>
              <th>Total</th>
              <th>Last 7 Days</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Bookings</td>
              <td>{{ $total1Bookings }}</td>
              <td>
                @if($bookingsLast7Days->count() > 0)
                  @foreach ($bookingsLast7Days as $booking)
                    <div class="container">{{ $booking->created_at->format('Y-m-d') }}</div>
                  @endforeach
                @else
                  No bookings in the last 7 days.
                @endif
              </td>
            </tr>
            <tr>
              <td>Cars Listed</td>
              <td>{{ $totalCars }}</td>
              <td>
                @if($carsLast7Days->count() > 0)
                  @foreach ($carsLast7Days as $car)
                    <div class="container">{{ $car->created_at->format('Y-m-d') }}</div>
                  @endforeach
                @else
                  No cars listed in the last 7 days.
                @endif
              </td>
            </tr>
            <tr>
              <td>Car Owners Registered</td>
              <td>{{ $totalCarOwners }}</td>
              <td>
                @if($carOwnersLast7Days->count() > 0)
                  @foreach ($carOwnersLast7Days as $carOwner)
                    <div class="container">{{ $carOwner->created_at->format('Y-m-d') }}</div>
                  @endforeach
                @else
                  No car owners registered in the last 7 days.
                @endif
              </td>
            </tr>
            <tr>
              <td>Customers Registered</td>
              <td>{{ $totalCustomers }}</td>
              <td>
                @if($customersLast7Days->count() > 0)
                  @foreach ($customersLast7Days as $customer)
                    <div class="container">{{ $customer->created_at->format('Y-m-d') }}</div>
                  @endforeach
                @else
                  No customers registered in the last 7 days.
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>

</div>
</html>
@include('components.footer')


