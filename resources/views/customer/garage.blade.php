@include('components.customer_header')

<body class="bg-cover bg-center h-full" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}');">
    <div class="bg-cover bg-black bg-opacity-50 backdrop-blur-lg w-full min-h-screen ">

    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

    @if ($bookings->isEmpty())
    <div class="h-56 grid grid-cols-3 gap-4 content-center bg-slate-100">
    <p class="mt-3"style="font-size:2vw">Your car bookings will display here!</p> 
    <div>
@else
        <div class="pt-5  mx-auto " >
            <table class="text-sm text-left text-blue-100 dark:text-blue-100 mx-auto shadow-md sm:rounded-lg max-w-full xs:max-w-none sm:max-w-xs md:max-w-sm  lg:max-w-md xl:max-w-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Car Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Car Owner
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Total Rental Fee
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-12 py-3">
                            Pickup Date and Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Return Date and Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                         </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($bookings as $booking)
                    <tr class="bg-gray-300 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-blue-100">
                            {{ $booking->car->car_brand }} - {{ $booking->car->car_model }}
                        </th>
                        <td class="px-1 py-4 text-gray-800">
                            {{ $booking->car->owner->first_name }} {{ $booking->car->owner->last_name }}
                        </td>
                        <td class="px-1 py-4 text-gray-800">
                            Php {{ $booking->total_rental_fee }}
                        </td>
                        <td class="px-6 py-4 text-gray-800">
                            {{ $booking->user->booking_status }}
                        </td>
                        <td class="pl-1 py-4 text-gray-800">
                            {{ date('F d, Y h:i A', strtotime($booking->pickup_date_time)) }}
                        </td>
                        <td class="px-6 py-4 text-gray-800">
                            {{ date('F d, Y h:i A', strtotime($booking->return_date_time)) }}
                        </td>
                        <td class="px-2 py-4">
                            <a href="#" class="font-medium text-blue-700 hover:underline" ddata-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Return Car</a><br>
                            <a href="#" class="font-medium text-blue-700 hover:underline">Extend</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Main Modal --}}


          
          <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                      <div class="p-6 text-center">
                          <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Return the car now?</h3>
                          <button data-modal-hide="popup-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <a href="{{ route('returncar', ['booking_id' => $booking->id]) }}"> Return now </a>
                          </button>
                          <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                      </div>
                  </div>
              </div>
          </div>
          
          @endif
        
    
        </div>
</body>
