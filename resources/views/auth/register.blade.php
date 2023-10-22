<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="flex items-center mt-2 gap-3">
            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('First Name')"/>
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name"/>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="last_name" :value="__('Last Name')"/>
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name"/>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')"/>
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="phone_number"/>
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2"/>
        </div>

        <!-- Profile Photo -->
        <div class="mt-4">
            <x-input-label for="profile_photo" :value="__('Profile Photo')"/>
            <x-text-input id="profile_photo" class="block mt-1 w-full" type="file" name="profile_photo" :value="old('profile_photo')"/>
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2"/>
        </div>

        <!-- Role (optional) -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')"/>
            <select id="role" name="role" class="block mt-1 w-full">
                <option value="student">Student</option>
                <option value="service-provider">Service Provider</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-400 hover:text-blue-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
