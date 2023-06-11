
<ul class="navbar-nav ml-auto">
    <li>
      <a href="{{ route('customer.garage') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Garage</a>
    </li>
    <li>
      <a href="{{ route('customer.history') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">History</a>
    </li>
    {{-- <li>
      <div class="sm:fixed sm:top-0 sm:right-0 text-right mr-2">
        <a href="{{ route('traverse-chats') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Traverse Chats</a>
      </div>
    </li> --}}
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
          <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </li>
  </ul>