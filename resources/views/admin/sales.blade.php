@include('components.header')
@section('content')
<div class="flex">
    <div class="sidebar text-white pt-8" style="background-color: #0C0C0C; min-height:100vh; width: 300px;">
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
        <h1 class="text-md font-bold text-4xl ml-4"> Overview</h1>
        <div class="flex flex-row space-x-8">
        <div class="flex flex-wrap space-x-3">
        <div class="mt-4 h-28 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
              <div class="text-gray-700 text-xl font-bold mr-2">Total Sales</div>
              <div class="bg-indigo-500 text-white rounded-lg px-4 py-2">
                <i class="fa-solid fa-peso-sign mr-2"></i>10,000
              </div>
            </div>
          </div>

          <div class="mt-4 h-28 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
              <div class="text-gray-700 text-xl font-bold mr-2">Total Profit</div>
              <div class="bg-indigo-500 text-white rounded-lg px-4 py-2">
                <i class="fa-solid fa-peso-sign mr-2"></i>10,000
              </div>
            </div>
          </div>

          <div class="mt-4 h-28 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
              <div class="text-gray-700 text-xl font-bold mr-2">Total Bookings</div>
              <div class="bg-indigo-500 text-white rounded-lg px-4 py-2">
                2,000
              </div>
            </div>
          </div>
    
        </div>
        
<div class="mt-4 h-96 bg-white rounded-lg shadow-md p-6" style="width: 250px;">
    <div class="text-gray-700 text-xl font-bold mr-2 flex justify-center items-center">Top Car Owner</div>
    <img class="mt-4 p-4 w-30 h-30 rounded-full mx-auto border-2 border-blue-700" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
    <p class="text-lg font-semibold text-blue-600 text-center p-4"> Car Owner Name </p>
</div>

 
        </div>
    </div>
        