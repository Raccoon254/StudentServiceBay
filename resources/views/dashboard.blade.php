<x-app-layout>
    <div class="h-5/6 text-white w-full flex flex-col items-center justify-center">

        <div class="text-5xl font-semibold">
            <h1 class="text-center"> THE STUDENT BAY</h1>
        </div>

        <div class="flex gap-4">
            Welcome to the student bay, a place where you can find all notices and updates for local companies, businesses and services.
        </div>

        @php

        $topRatedCompanies = App\Models\ServiceProvider::with('serviceReviewRatings')
            ->withCount(['serviceReviewRatings as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rating),0)'));
            }])
            ->orderByDesc('average_rating')
            ->take(3)
            ->get();

        @endphp

        <div class="top mt-8">
            <h2 class="text-3xl text-center font-semibold">Top Rated Companies</h2>
            <div class="flex mt-4 gap-4">

                @foreach($topRatedCompanies as $company)
                    <div class="shadow shadow-gray-50 overflow-clip p-1 w-[200px] rounded-md">
                        <div class="img">
                            <img src="{{ asset('storage/profile_photos/' . $company->profile_image) }}" alt="{{ $company->company_name }}" class="rounded-md w-[200px] h-[150px] object-cover" />
                        </div>
                        <div class="more-data flex flex-col gap-2 p-1 bg-gradient-to-b from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-900 rounded-md hover:shadow-lg">
                            @php($companyNameShort = strlen($company->company_name) > 15 ? substr($company->company_name, 0, 15) . '...' : $company->company_name)

                            <h3 class="text-xl">{{ $companyNameShort }}</h3>
                            <p class="text-xs">Average Rating: {{ number_format($company->average_rating, 1) }}</p>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $company->average_rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</x-app-layout>
