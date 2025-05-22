<x-guest-layout>
    <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">{{ __('Create an Account') }}</h1>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-user"></i>
                </span> 
                <x-text-input id="name" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200" 
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span> 
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200" 
                    type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="password" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Password must be at least 8 characters and contain letters and numbers</p>
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200"
                    type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-5">
            <div class="flex items-center">
                <input id="terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer">
                <label for="terms" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">
                    {{ __('I agree to the') }} <a href="#" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">{{ __('Terms of Service') }}</a> {{ __('and') }} <a href="#" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">{{ __('Privacy Policy') }}</a>
                </label>
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200 text-white font-medium rounded-lg">
                <i class="fas fa-user-plus mr-2"></i> {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="mt-6 pt-5 text-center border-t border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-400">{{ __('Already have an account?') }}
                <a class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium transition-colors duration-200" href="{{ route('login') }}">
                    {{ __('Sign in') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>