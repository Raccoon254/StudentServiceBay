<x-app-layout>

    <div class="container text-white flex gap-4">

        @php
         if(isset($scam)){
              $serviceProvider = $scam->serviceProvider;
            }
        @endphp
        <div class="left w-1/3 border-r-2 border-r-gray-200">
            <img src="{{ asset('storage/profile_photos/' . $scam->serviceProvider->profile_image) }}" class="card-img-top rounded-[12px] m-1 w-40 h-40 object-cover" alt="...">
        </div>
        <div class="right w-2/3">
            <div class="data">
                <h1 class="text-3xl w-fit">
                    {{ $scam->serviceProvider->company_name }}
                </h1>
                <livewire:service-provider-rating :serviceProvider="$serviceProvider" key="{{ $scam->serviceProvider->id }}" />

                <div class="flex flex-col gap-4 justify-between text-white">
                    <div class="desc flex flex-col gap-4 my-4">
                        <div class="report flex flex-col">
                            <div class="text-2xl">
                                Scam Report
                            </div>
                            <span class="text-sm">
                                The scam incident happened on {{ $scam->date_reported }} at {{ $scam->location_area }}.
                            </span>
                            <span class="text-sm">
                                Reported by
                                <span class="text-green-400">
                                    {{ $scam->user->first_name }} {{ $scam->user->last_name }}
                                </span>
                            </span>
                        </div>
                        <div class="desc">
                            <div class="text-2xl">
                                Scam Description
                            </div>
                            <p class="">
                                {{ $scam->description }}
                            </p>
                        </div>
                    </div>

                    <div class="info my-3 flex gap-4 items-center">
                        <div class="email flex gap-2 items-center">
                            <i class="fa-solid fa-envelope"></i>
                            <span class="text-xs">
                            {{ $scam->serviceProvider->email }}
                        </span>
                        </div>

                        <div class="contact flex gap-2 items-center">
                            <i class="fa-solid fa-phone-flip"></i>
                            <span class="text-xs">
                            {{ $scam->serviceProvider->contact_number }}
                        </span>
                        </div>

                        <div class="verified {{ $scam->serviceProvider->isVerified ? 'text-green-400' : 'text-red-600' }} text-xs flex gap-2">
                            @if($scam->serviceProvider->isVerified)
                                VERIFIED
                            @else
                                NOT VERIFIED
                            @endif
                        </div>

                    </div>

                    <div class="3recentReviews">

                        <h1 class="text-2xl">
                            Recent Reviews for {{ $scam->serviceProvider->company_name }}
                        </h1>

                        @php($ratings = $scam->serviceProvider->serviceReviewRatings->sortByDesc('created_at')->take(3))
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
