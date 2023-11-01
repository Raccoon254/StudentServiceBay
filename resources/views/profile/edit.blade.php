<x-app-layout>
    <div class="py-12">


        <div class="max-w-7xl bg-gray-500 bg-opacity-30 backdrop-blur-sm p-6 rounded-md mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex">
                <div class="w-1/2">
                    <img src="{{ asset("/storage/profile_photos/".$user->profile_photo) }}" alt="{{ $user->name }}" class="h-60 w-60 rounded-full flex items-center justify-center">
                </div>
                <div class="w-1/2">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="flex">
                <div class="flex w-full gap-3">
                    <div class="w-1/2">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-300">
                                    {{ __('Profile Information') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-400">
                                    {{ __("Below is your Full data inStudent Service Bay. We protect your data fro privacy") }}
                                </p>
                            </header>

                            <div class="mt-6">
                                <x-input-label for="last_name" :value="__('Name')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->name)"  />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"  />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone_number)"  />
                            </div>

                           </section>

                    </div>

                    <div class="w-1/2">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
