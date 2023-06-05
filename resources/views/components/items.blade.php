<ul class="navbar-nav mr-auto">
                           
    <a href="{{ route('faq') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> FAQ </a>


    <a href="{{ route('ourteam') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> Our Team</a>

    @if (Route::has('login'))
    
            @auth
                <a href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Home</a>
            @else
                <a href="{{ route('login') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Register</a>
                @endif
            @endauth
        
    @endif

    <div class="sm:fixed sm:top-0 sm:right-0 text-right">

            <a href="{{ route('contact') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Contact Us! </a>
    </div>



</ul>