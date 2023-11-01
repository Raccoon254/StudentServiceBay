<x-guest-layout>
    <div class="container mx-auto mt-10">
        <div class="w-full max-w-xs mx-auto">
            <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-xl mb-4">Two Factor Authentication</h2>

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
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="two_factor_code">
                            Enter the code sent to your email
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="two_factor_code" type="text" placeholder="******" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Verify
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
