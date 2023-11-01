<x-app-layout>
    <div class="container py-5">
        <div class="row">

            <center class="mb-5">
                <h1 class="text-4xl text-white font-bold">Scam Reports</h1>
            </center>

            @foreach($scams as $scam)
                <div class="col-md-4 bg-gray-500 bg-opacity-20 rounded-2xl shadow-sm shadow-gray-300 backdrop-blur-sm mb-8 hover:bg-opacity-100 transition duration-500 ease-in-out">
                    <div class="flex gap-8 justify-start">
                        <div class="img">
                            <img src="{{ asset('storage/profile_photos/' . $scam->serviceProvider->profile_image) }}" class="card-img-top rounded-l-[12px] m-1 w-40 h-40 object-cover" alt="...">
                        </div>
                        <div class="flex flex-col justify-between text-white">
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

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
