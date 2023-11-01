<x-app-layout>
    <div class="container py-2">
        <div class="row">

            <center class="mb-5">
                <h1 class="text-5xl text-white font-bold">Service Providers</h1>
            </center>

            @foreach($serviceProviders as $serviceProvider)
                <div class="col-md-4 bg-gray-600 bg-opacity-20 rounded-2xl shadow-sm shadow-gray-300 backdrop-blur-sm mb-8 hover:bg-opacity-50 transition duration-500 ease-in-out">
                    <div class="flex gap-8 justify-start">
                        <div class="img relative w-1/4">
                            <img src="{{ asset('storage/profile_photos/' . $serviceProvider->profile_image) }}" class="card-img-top rounded-l-[12px] m-1 w-60 h-60 object-cover" alt="...">
                            <span class="absolute left-[4px] text-lg top-[2px] text-gray-400">
                                         @if($serviceProvider->isVerified)
                                    <i class="fa-solid fa-lg fa-check-circle text-green-400"></i>
                                @else
                                    <i class="fa-solid fa-lg fa-times-circle text-red-600"></i>
                                @endif
                                    </span>
                        </div>
                        <div class="flex w-3/4 flex-col justify-between text-white">
                            <div class="my-4">
                                <h5 class="text-3xl w-fit">
                                    {{ $serviceProvider->company_name }}
                                </h5>
                                <p class="text-sm">
                                    {{ $serviceProvider->description }}
                                </p>
                                <div class="ratings mt-4">
                                    @php
                                        $averageRating = $serviceProvider->serviceReviewRatings->avg('rating');
                                    @endphp

                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $averageRating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor

                                    <p class="text-[10px]">{{ number_format($averageRating, 1) }} based on {{ $serviceProvider->serviceReviewRatings->count() }} reviews</p>
                                </div>
                            </div>
                            <p class="flex items-center my-2 gap-4">
                                <span class="date flex gap-2">
                                    <i class="fa-solid fa-envelope-circle-check"></i>
                                    <span class="text-xs">
                                        {{ $serviceProvider->email }}
                                    </span>
                                </span>
                                <span class="loc flex gap-2">
                                    <i class="fa-solid fa-phone-flip"></i>
                                    <span class="text-xs">
                                        {{ $serviceProvider->contact_number }}
                                    </span>
                                </span>
                                <span class="verified {{ $serviceProvider->isVerified ? 'text-green-400' : 'text-red-600' }} text-xs flex gap-2">
                                    @if($serviceProvider->isVerified)
                                        VERIFIED
                                    @else
                                        NOT VERIFIED
                                    @endif
                                </span>
                            </p>
                        </div>

                        <div class=" absolute right-2 text-xs top-2 text-gray-400">
                            OWNER: {{ $serviceProvider->user->name ?? '' }}
                        </div>

                    </div>
                </div>
            @endforeach


            <!-- Pagination -->
            <div class="pagination mt-5">
                {{ $serviceProviders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

