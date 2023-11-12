<div>
    @foreach($reviews as $review)
        @php($serviceProvider = \App\Models\ServiceProvider::find($review->service_provider_id))
        <div class="col-md-4 bg-gray-600 bg-opacity-0 rounded-md shadow-sm shadow-gray-300 backdrop-blur-sm mb-8 hover:bg-opacity-20 transition duration-500 text-white ease-in-out">
            <div class="flex gap-8 justify-start">
                <div class="review-item flex flex-col gap-3 p-4">
                    <h5 class="text-3xl w-fit">
                        {{ $serviceProvider->company_name }}
                    </h5>
                    <p>{{ $review->comments ?? 'No comments' }}</p>
                    <p>
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                    </p>
                    <x-primary-button class="btn-sm ring-1 w-[100px] ring-white" wire:click="edit({{ $review->id }})">Edit</x-primary-button>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Modal -->
    @if($showEditModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <!-- Modal Background -->

                <!-- Modal Content -->
                <div class="fixed z-50 bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg">Edit Review</h3>
                    <!-- Edit review form -->
                    <textarea wire:model.defer="currentReviewComments" class="w-full mt-2 ring border rounded"></textarea>
                    <input type="number" wire:model.defer="currentReviewRating" class="w-full mt-2 ring rounded border">
                    <div class="mt-4">
                        <button wire:click="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save
                        </button>
                        <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                    </div>
                </div>
                <div class="fixed z-10 inset-0 bg-black opacity-50"></div>
            </div>
        </div>
    @endif


</div>
