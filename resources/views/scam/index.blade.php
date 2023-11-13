<x-app-layout>
    <div class="container py-2">
        <div class="row">

            <center class="mb-5">
                <h1 class="text-5xl text-white font-bold">Scam Reports</h1>
            </center>
            <a href="{{ route('scam.create') }}">
                <div class="create-scam-report absolute right-5 top-4 flex text-white gap-4 bg-red-600 bg-opacity-100 ring ring-white hover:bg-opacity-50 p-2 rounded-full">
                    Report a Scam
                    <button class="btn btn-xs btn-circle ring">

                            <i class="fa-solid fa-lg fa-plus"></i>
                    </button>
                </div>
            </a>


            @foreach($scams as $scam)
                <div class="col-md-4 bg-gray-500 bg-opacity-20 rounded-2xl shadow-sm shadow-gray-300 backdrop-blur-sm mb-8 hover:bg-opacity-100 transition duration-500 ease-in-out">
                    <div class="flex gap-8 justify-start">
                        <div class="img w-1/4">
                            <img src="{{ asset('storage/profile_photos/' . $scam->serviceProvider->profile_image) }}" class="card-img-top rounded-l-[12px] m-1 w-52 h-52 object-cover" alt="...">
                        </div>
                        <div class="flex  w-3/4 flex-col justify-between text-white">
                            <div class="my-4">
                                <h5 class="text-3xl">{{ $scam->serviceProvider->company_name }}</h5>
                                <p class="text-sm">
                                    {{ $scam->description }}
                                </p>
                            </div>
                            <p class="flex my-2 gap-4">
                                <span class="date flex gap-2">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span class="text-xs">
                                        {{ $scam->date_reported }}
                                    </span>
                                </span>
                                <span class="loc flex gap-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-xs">
                                        {{ $scam->location_area }}
                                    </span>
                                </span>
                            </p>
                        </div>

                        <div class=" absolute right-2 text-xs top-2 text-gray-400">
                            Reported By: {{ $scam->user->first_name }} {{ $scam->user->last_name }}
                        </div>

                        <a href="{{ route('scam.show', $scam) }}">
                            <div class="create-scam-report absolute right-2 bottom-2 flex text-white gap-4 bg-blue-600 bg-opacity-0 ring-white ring-1 hover:bg-opacity-50 p-2 rounded-[8px]">
                                View Details
                            </div>
                        </a>

                    </div>
                </div>
            @endforeach


            <!-- Pagination -->
            <div class="flex justify-between w-full">
                {{ $scams->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
