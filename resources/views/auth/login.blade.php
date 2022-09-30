<x-guest-layout>

       <!--Nav-->
       <nav id="header" class="fixed w-full z-30 top-0 bg-[#07415B] text-white">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
          <div class="pl-4 flex  items-center">
            <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl">
              <!--Icon from: http://www.potlabicons.com/ -->
  
               <img class="w-10 inline" src="{{ asset('user_assets/assets/images/branding_evisitors.jpg') }}" width="100" >
              <span class="inline" >EVS</span>
            </a>
          </div>
          <div class="block lg:hidden pr-4 mt-20">
            <button id="nav-toggle" class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
              <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
              </svg>
            </button>
          </div>
          <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
            <ul class="list-reset flex  md:flex-row justify-end flex-1 items-center">
         
              <li class="mr-3">
                <a class="mx-auto nav-link  lg:mx-0 hover:underline bg-[#2879A5]
                 text-white font-bold rounded-full mt-4 lg:mt-0 py-3 
                 px-6 shadow opacity-75 focus:outline-none focus:shadow-outline 
                 transform transition hover:scale-105 duration-500 ease-in-out" 
                href="{{route('home')}}"> Home</a>
              </li>
  
              {{-- <li class="mr-3">
                <a class="mx-auto nav-link lg:mx-0 hover:underline bg-[#2879A5]
                 text-white font-bold rounded-full mt-4 lg:mt-0 py-3 
                 px-6 shadow opacity-75 focus:outline-none focus:shadow-outline 
                 transform transition hover:scale-105 duration-500 ease-in-out" 
                href="{{route('dashboard')}}"> Staff</a>
              </li> --}}
  
              <li class="mr-3 none md:block">
                <a class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800
                 font-bold no-underline rounded-full mt-4 lg:mt-0 py-4 px-8 shadow 
                 opacity-75 focus:outline-none focus:shadow-outline transform transition
                  hover:scale-105 duration-500 ease-in-out" 
                href="{{route('dashboard')}}"> Admin </a>
              </li>
              
            </ul>
          </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
      </nav>
      <!--Hero-->


    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        <h1 class="text-center text-slate-900 font-mono text-[28px] "> Login </h1>

        </x-slot>


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
