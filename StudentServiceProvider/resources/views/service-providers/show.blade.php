<x-app-layout>

    <div class="container text-white flex gap-4">
        <div class="left w-1/3 border-r-2 border-r-gray-200">
            <img src="{{ asset('storage/profile_photos/' . $serviceProvider->profile_image) }}" class="card-img-top rounded-[12px] m-1 w-40 h-40 object-cover" alt="...">
        </div>
        <div class="right w-2/3">
            <div class="data">
                <h1 class="text-3xl w-fit">
                    {{ $serviceProvider->company_name }}
                </h1>
                <livewire:service-provider-rating :serviceProvider="$serviceProvider" key="{{ $serviceProvider->id }}" />

                <div class="flex flex-col gap-4 justify-between text-white">
                    <div class="desc my-4">
                        <p class="text-xs">
                            {{ $serviceProvider->description }}
                        </p>
                    </div>

                    <div class="info my-3 flex gap-4 items-center">
                        <div class="email flex gap-2 items-center">
                            <i class="fa-solid fa-envelope"></i>
                            <span class="text-xs">
                            {{ $serviceProvider->email }}
                        </span>
                        </div>

                        <div class="contact flex gap-2 items-center">
                            <i class="fa-solid fa-phone-flip"></i>
                            <span class="text-xs">
                            {{ $serviceProvider->contact_number }}
                        </span>
                        </div>

                        <div class="verified {{ $serviceProvider->isVerified ? 'text-green-400' : 'text-red-600' }} text-xs flex gap-2">
                            @if($serviceProvider->isVerified)
                                VERIFIED
                            @else
                                NOT VERIFIED
                            @endif
                        </div>

                    </div>

                    <div class="3recentReviews">

                        <h1 class="text-2xl">
                            Recent Reviews
                        </h1>

                        @php($ratings = $serviceProvider->serviceReviewRatings->sortByDesc('created_at')->take(3))
                        <div class="reviews flex justify-between">
                            @foreach($ratings as $review)
                                <div class="review shadow shadow-gray-300 m-1 p-2 rounded w-1/3">
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="comment text-xs">
                                        {{ $review->comments }}
                                    </div>
                                    <div class="date mt-2 text-[8px]">
                                        {{ $review->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
