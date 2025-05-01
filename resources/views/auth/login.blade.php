<x-guest-layout> 
    <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">{{ __('Welcome Back') }}</h1>
    
    <!-- Session Status --> 
    <x-auth-session-status class="mb-4" :status="session('status')" /> 

    <form method="POST" action="{{ route('login') }}"> 
        @csrf 

        <!-- Email Address --> 
        <div class="mb-5"> 
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span> 
                <x-text-input class="mt-1 block w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200" 
                    id="email" name="email" type="email" :value="old('email')" required autocomplete="email" placeholder="your@email.com" /> 
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" /> 
        </div> 

        <!-- Password --> 
        <div class="mb-5"> 
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input class="mt-1 block w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200" 
                    id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('password')" /> 
        </div> 

        <!-- Remember Me --> 
        <div class="mt-5 block"> 
            <label class="inline-flex items-center cursor-pointer" for="remember_me"> 
                <input 
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer" 
                    id="remember_me" name="remember" type="checkbox"> 
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span> 
            </label> 
        </div> 

        <div class="mt-6"> 
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200 text-white font-medium rounded-lg"> 
                <i class="fas fa-sign-in-alt mr-2"></i> {{ __('Log in') }} 
            </x-primary-button>
        </div>
        
        <div class="mt-4 flex items-center justify-center"> 
            @if (Route::has('password.request')) 
                <a class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200" 
                    href="{{ route('password.request') }}"> 
                    {{ __('Forgot your password?') }} 
                </a> 
            @endif 
        </div>
    </form> 

    <div class="mt-6 pt-5 text-center border-t border-gray-200 dark:border-gray-700"> 
        <p class="text-gray-600 dark:text-gray-400">{{ __('Don\'t have an account?') }} 
            <a class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium transition-colors duration-200" href="{{ route('register') }}">
                {{ __('Register now') }}
            </a>
        </p> 
    </div>
</x-guest-layout>