<x-app-layout>

    <div class="container py-2">
        <div class="row">

            <center class="mb-5">
                <h1 class="text-5xl text-white font-bold">Reviews</h1>
            </center>

            @foreach($reviews as $review)
                {{$review->id}}
            @endforeach

</x-app-layout>
