<nav x-data="{open : false}" class="navbar navbar-expand-md navbar-light shadow-sm fixed-top border-bottom" style="background-color: #0C0C0C;">
    <div class="container">
        <a class="navbar-brand flex items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Traverse</span>
        </a>
       {{-- <a href="/">
           <span class="self-center text-xl front-semibold whitespace-nowrap">{{$data ['title'] }}</span>
       </a> --}}
        <button @click="open = !open" data-collapse-toggle="navbar-main" class="md:hidden right-0">
        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48" style="fill: white;"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg>
        </button>
       <div x-show="open" class="right-0 w-full md:block md:w-auto" id="navbar-main">
            <x-items/>
        </div>
        {{-- <div class="hidden w-full md:block md:w-auto" id="navbar-main">
            <x-items />
            </div> --}}
    </div>
   </nav>