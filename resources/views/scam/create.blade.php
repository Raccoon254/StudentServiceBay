<x-app-layout>
    <div class="container text-white mx-auto p-6">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl text-center font-semibold mb-4">Report a Scam</h1>
            <form action="{{ route('scam.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="service_provider" class="block text-sm font-medium mb-2">Service Provider:</label>
                    <select id="service_provider" name="service_provider" class="block w-full py-2 px-3 border border-gray-300 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($serviceProviders as $provider)
                            <option class="text-gray-900" value="{{ $provider->id }}">{{ $provider->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium mb-2">Description:</label>
                    <textarea id="description" name="description" rows="4" class="block w-full py-2 px-3 border border-gray-300 bg-white text-gray-900  rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Describe the scam incident..."></textarea>
                </div>

                <div class="mb-4">
                    <label for="location_area" class="block text-sm font-medium mb-2">Location/Area:</label>
                    <input type="text" id="location_area" name="location_area" class="block w-full py-2 px-3 border border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter the location of the incident">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-700">Report Scam</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
