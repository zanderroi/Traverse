<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Traverse</title>
        <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">
        <link rel="stylesheet" href="css/styles.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
         <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        {{-- Flowbite Tailwind --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

          {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: rgb(221, 221, 221); ">
       
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top" style="background-color: #0C0C0C;">
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
                           
                                <a href="{{ url('faq/') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> FAQ </a>
                          
                          
                                <a href="{{ url('ourteam/') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> Our Team</a>
                           
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
            </div>
            </nav>
    
        </div>
        <div class="mt-2 pt-4 pb-5 mx auto h-32" style="background-color: #0C0C0C;">
            <h2 class="pt-4 mt-4 ml-4 text-3xl font-semi-bold text-white text-center sm:text-2xl">We're always here to help!</h2>
        
            <div class="flex justify-center mt-4 sm:flex-row">
                <input type="text" id="searchInput"  placeholder="Search" class="px-4 w-1/2 xs:w-auto py-2 rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button onclick="searchContent()" class="px-4 py-2 ml-2 bg-blue-500 text-white rounded-sm">Search</button>
            </div>
        </div>
        <div class="mt-2 mx-auto rounded-lg shadow-md bg-gray-100 mb-4" style="max-width: 1400px;">
            <div>
                <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
            
                width: 100%;
                text-align: left;
                ">What is Traverse?</button>
                 <div class="content" style="padding: 0 18px;
                 display: none;
                 overflow: hidden;
                ">
                     <p class="px-6 mt-2">Traverse is a modern web-based car rental system designed to provide customers with a convenient booking platform and reliable transportation. It has a front-end and back-end system, booking page, booking history, it also includes an anti-theft mechanism with GPS tracking and a reports feature for managing the system. </p>
                   </div>
            <hr class="mt-2 text-gray-500">
            <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
            width: 100%;
            text-align: left;
            ">Fuel</button>
             <div class="content" style="padding: 0 18px;
             display: none;
             overflow: hidden;">
                 <p class="px-6 mt-2">Full tank on pickup and full tank on return </p>
               </div>
               <hr class="mt-2 text-gray-500">
               <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
               width: 100%;
               text-align: left;
               ">Do you have insurance?</button>
                <div class="content" style="padding: 0 18px;
                display: none;
                overflow: hidden;">
                    <p class="px-6 mt-2">1. Collision Damage Waiver (CDW) - This policy covers the rental vehicle in the event of a collision or accident, and can be purchased by the renter or included in the rental rate. It typically has a deductible, or amount that the renter is responsible for paying in the event of damage.</p>
                    <br>
                    <p class="px-6">2. Liability Insurance - This policy covers damages or injuries that the renter or driver may cause to others while driving the rental vehicle. It is usually required by law and can be included in the rental rate or purchased separately.</p>
                    <br>
                    <p class="px-6">3. Personal Accident Insurance (PAI) - This policy provides coverage for medical expenses and accidental death or dismemberment of the renter or passengers in the rental vehicle. </p>
                    <br>
                    <p class="px-6">4. Personal Effects Coverage - This policy covers loss or damage to personal items that are stolen or damaged while inside the rental vehicle.</p>
                    <br>
                    <p class="px-6">5. Roadside Assistance - This policy provides assistance in the event of a breakdown, flat tire, or other issue that leaves the renter stranded on the side of the road.</p>
                </div>
                <hr class="mt-2 text-gray-500">
                <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                width: 100%;
                text-align: left;
                ">Where do I pick up the vehicle?</button>
                 <div class="content" style="padding: 0 18px;
                 display: none;
                 overflow: hidden;">
                     <p class="px-6 mt-2">The vehicle must be picked up at the agreed-upon rental location at the designated time. Failure to do so may result in additional charges or cancellation of the rental agreement. </p>
                   </div>
                   <hr class="mt-2 text-gray-500">
                   <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                   width: 100%;
                   text-align: left;
                   ">Can I have the vehicle delivered?</button>
                    <div class="content" style="padding: 0 18px;
                    display: none;
                    overflow: hidden;">
                        <p class="px-6 mt-2">Delivery services may be available depending on what the customer and car owner has agreed-upon. Please contact us the car owner for more details regarding the car</p>
                      </div>
                      <hr class="mt-2 text-gray-500">
                      <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                      width: 100%;
                      text-align: left;
                      ">Where can I return the vehicle?</button>
                       <div class="content" style="padding: 0 18px;
                       display: none;
                       overflow: hidden;">
                           <p class="px-6 mt-2">The vehicle must be returned to the same rental location at the agreed-upon time. Failure to do so may result in additional charges or penalties.</p>
                         </div>
                         <hr class="mt-2 text-gray-500">
                         <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                         width: 100%;
                         text-align: left;
                         ">Is it possible to extend my rental?</button>
                          <div class="content" style="padding: 0 18px;
                          display: none;
                          overflow: hidden;">
                              <p class="px-6 mt-2">Extensions are allowd one day after the return date selected. If you wish to extend your rental for more than a day, please contact the car owner as soon as possible to make arrangements. Late returns may result in additional charges or penalties.</p>
                            </div>
                            <hr class="mt-2 text-gray-500">
                            <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                            width: 100%;
                            text-align: left;
                            ">Age Restriction</button>
                             <div class="content" style="padding: 0 18px;
                             display: none;
                             overflow: hidden;">
                                 <p class="px-6 mt-2">Must be at least seventeen (17) years old and must be physically and mentally fit to operate a vehicle. In addition, for foreigners, the applicant must be eighteen (18) years old and must have been in the Philippines for at least one (1) year from date of application.</p>
                               </div>
                               <hr class="mt-2 text-gray-500">
                               <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                               width: 100%;
                               text-align: left;
                               ">What are the available payment methods?</button>
                                <div class="content" style="padding: 0 18px;
                                display: none;
                                overflow: hidden;">
                                    <p class="px-6 mt-2">Payment transactions are between customers and car owners face to face as we recommended. It may be cash, bank transfer or digital wallets. Please contact the car owner for preferred payment method</p>
                                  </div>
                                  <hr class="mt-2 text-gray-500">
                                  <button class="collapsible  px-6 pt-2 text-lg font-bold bg-gray-100 hover:bg-gray-200" type="button" style="cursor: pointer;
                                  width: 100%;
                                  text-align: left;
                                  ">How can I register?</button>
                                   <div class="content" style="padding: 0 18px;
                                   display: none;
                                   overflow: hidden;">
                                       <p class="px-6 mt-2">You can register  <a href="{{ route('register') }}" class="text-blue-700">here</a> and submit clear photo of your IDs.</p>
                                     </div>
                                     <hr class="mt-2 text-gray-500">
            </div>
        </div>
           
        </div>
        <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;
            
            for (i = 0; i < coll.length; i++) {
              coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                  content.style.display = "none";
                } else {
                  content.style.display = "block";
                }
              });
            }
          
            function searchContent() {
        var searchTerm = document.getElementById('searchInput').value.toLowerCase();
        var searchWords = searchTerm.split(' ');
        var contentElements = document.getElementsByClassName('content');
        
        for (var i = 0; i < contentElements.length; i++) {
            var content = contentElements[i].textContent.toLowerCase();
            var matched = false;
            
            for (var j = 0; j < searchWords.length; j++) {
                var word = searchWords[j];
                var wordRegExp = new RegExp('\\b' + word + '\\b', 'gi'); // Match whole words only
                
                if (content.match(wordRegExp)) {
                    matched = true;
                    content = content.replace(wordRegExp, function(match) {
                        return '<span class="highlight">' + match + '</span>';
                    });
                }
            }
            
            contentElements[i].innerHTML = content;
            
            if (matched) {
                contentElements[i].style.display = 'block';
            } else {
                contentElements[i].style.display = 'none';
            }
        }
    }
            </script>
            <style>
                .highlight {
                    background-color: yellow;
                    font-weight: bold;
                }
            </style>
            @include('components.footer')
    </body>
</html>