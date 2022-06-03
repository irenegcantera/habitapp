<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('logo/logo-inicio.png') }}" alt="" width="300" height="100" class="d-inline-block align-text-top">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}
            <div class="flex items-center justify-end mt-4">
                
            </div>
            <div class="flex items-center justify-end mt-4 mb-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('registrar') }}">
                    {{ __('¿No se encuentra registrado?') }}
                </a>
                                
                <x-button class="ml-3">
                    {{ __('Acceder') }}
                </x-button>  
            </div>
            <x-a href="{{ route('index') }}"> 
                <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrow-left">
                        <symbol id="bi-arrow-left" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </symbol>
                    </svg>
                    <use xlink:href="#bi-arrow-left"/>
                </svg>&nbsp;Volver atrás
            </x-a>
        </form>
    </x-auth-card>
</x-guest-layout>


