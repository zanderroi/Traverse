
<ul class="navbar-nav ml-auto">
    <li>
        <a href="{{ route('car_owner.rentedcars') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">
          @if (isset($bookedCarsCount) && $bookedCarsCount > 0)
        <span class="bg-red-500 text-white rounded-full px-1.5">{{ $bookedCarsCount }}</span>
    @endif
            Rented Cars
        </a>
    </li>
    
        <li>
          <a href="{{ route('car_owner.earnings') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Earnings!</a>
        </li>
        <li>
          <a href="{{ route('car_owner.car_details') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">List a Car</a>
        </li>

    <li>
      <div class="flex items-center">
        @if ($latestProfilePicture)
        <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' .$latestProfilePicture->profilepicture) }}" alt="Profile Picture">
    @else
        <img class="w-8 h-8 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
    @endif
        <a id="navbarDropdown" class="py-2 dropdown-toggle ml-2 text-gray-300 hover:bg-blue-80 font-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->first_name }}
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('car_owner.profile') }}">Profile</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </li>
  </ul>