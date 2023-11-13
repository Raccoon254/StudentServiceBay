<x-guest-layout>
    <div class="container mx-auto mt-10">
        <div class="w-full max-w-xs mx-auto">
            <div class="shadow-sm shadow-gray-300 rounded-lg px-8 pt-6 pb-8 mb-4">
                <center class="text-xl text-white mb-4">Two Factor Authentication</center>

                @if(session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->has('two_factor'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ $errors->first('two_factor') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('two-factor.verify') }}">
                    @csrf

                    <div class="mb-4">
                        <center class="block text-white text-sm my-4" for="two_factor_code">
                            Enter the code sent to your email
                        </center>
                        <x-text-input class="shadow ring ring-blue-50 appearance-none border rounded w-full h-12" name="two_factor_code" type="text" placeholder="0000" required>
                        </x-text-input>
                    </div>

                    <div class="flex items-center justify-between">
                        <x-secondary-button class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Verify
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
