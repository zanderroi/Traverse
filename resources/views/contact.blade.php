<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

</head>
<body class="pt-5 bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage7.jpg') }}');">
  <div class="bg-black bg-opacity-75 backdrop-blur-lg">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top border-bottom" style="background-color: #0C0C0C;">
      <div class="container">
          <a class="navbar-brand flex items-center" href="{{ route('welcome') }}">
              <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
              <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Traverse</span>
          </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button> 

          
          <div id="navbarSupportedContent">

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto">
                 
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

                      <div class="sm:fixed sm:top-0 sm:right-0 text-right ml-6">

                              <a href="{{ route('contact') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Contact Us! </a>
                      </div>
             


              </ul>
          
      </div>
  </nav>


<!-- component -->
<div class="mx-auto flex justify-center items-center w-1/2 bg-white">
	<!-- COMPONENT CODE -->
	<div class="container mx-auto my-4 px-4 lg:px-20">

		<div class="w-full p-8 my-4 md:px-12 lg:w-9/12 lg:pl-20 lg:pr-40 mr-auto rounded-2xl shadow-2xl">
			<div class="flex">
				<h1 class="font-bold uppercase text-5xl">Send us a <br /> message</h1>
			</div>
			<div class="grid grid-cols-1 gap-5 md:grid-cols-2 mt-5">
				<input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="text" placeholder="First Name*" />
				<input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="text" placeholder="Last Name*" />
				<input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="email" placeholder="Email*" />
				<input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="number" placeholder="Phone*" />
        </div>
				<div class="my-4">
					<textarea placeholder="Message*" class="w-full h-32 bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"></textarea>
				</div>
				<div class="my-2 w-1/2 lg:w-1/4">
					<button class="uppercase text-sm font-bold tracking-wide bg-blue-900 text-gray-200 p-3 rounded-lg w-full 
                      focus:outline-none focus:shadow-outline">
            Send Message
          </button>
				</div>
			</div>

			<div
				class="w-full lg:-mt-96 lg:w-2/6 px-8 py-12 ml-auto bg-blue-900 rounded-2xl">
				<div class="flex flex-col text-white">
					<h1 class="font-bold uppercase text-4xl my-4">Drop in our office</h1>
					<p class="text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
						tincidunt arcu diam,
						eu feugiat felis fermentum id. Curabitur vitae nibh viverra, auctor turpis sed, scelerisque ex.
					</p>

					<div class="flex my-4 w-2/3 lg:w-1/2">
						<div class="flex flex-col">
							<i class="fas fa-map-marker-alt pt-2 pr-2" />
            </div>
            <div class="flex flex-col">
              <h2 class="text-2xl">Main Office</h2>
              <p class="text-gray-400">xxxxxxxxxxxxxxxxxxxxx</p>
            </div>
          </div>
          
          <div class="flex my-4 w-2/3 lg:w-1/2">
            <div class="flex flex-col">
              <i class="fas fa-phone-alt pt-2 pr-2" />
            </div>
            <div class="flex flex-col">
              <h2 class="text-2xl">Call Us</h2>
              <p class="text-gray-400">Tel: xxx-xxx-xxx</p>
              <p class="text-gray-400">Fax: xxx-xxx-xxx</p>
            </div>
          </div>
          
          <div class="flex my-4 w-2/3 lg:w-1/2">
            <a href="https://www.facebook.com/ENLIGHTENEERING/" target="_blank" rel="noreferrer" class="rounded-full bg-white h-8 w-8 inline-block mx-1 text-center pt-1">
              <i class="fab fa-facebook-f text-blue-900" />
            </a>
            <a href="https://www.linkedin.com/company/enlighteneering-inc-" target="_blank" rel="noreferrer" class="rounded-full bg-white h-8 w-8 inline-block mx-1 text-center pt-1">
              <i class="fab fa-linkedin-in text-blue-900" />
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- COMPONENT CODE -->
</div>

<!-- BUY ME A PIZZA AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
{{-- <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
  <div>
    <a title="Buy me a pizza" href="https://www.buymeacoffee.com/Dekartmc" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
      <img class="object-cover object-center w-full h-full rounded-full" src="https://img.icons8.com/emoji/48/000000/pizza-emoji.png"/>
    </a>
  </div>
</div> --}}
</div>
</body>
</html>