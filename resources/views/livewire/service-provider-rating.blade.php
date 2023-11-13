<div>
    <div class="rating flex flex-col mt-4">

        <div class="text-[10px] mb-2" wire:click="$set('showModal', true)">
            Click on the stars to rate
        </div>
        <div class="flex gap-5 justify-start">
            @for($i = 1; $i <= 5; $i++)

                <button class="btn btn-xs btn-circle btn-outline-primary relative" wire:click="setRating({{ $i }})" data-tip="Click to rate {{ $i }} stars">
                <span class="grid place-items-center h-full text-white w-full absolute top-2 left-0 z-10 tooltip tooltip-primary" data-tip="Click to rate {{ $i }} stars">
                    {{ $i }}
                </span>
                    <span class="star tooltip tooltip-primary" data-tip="Click to rate {{ $i }} stars">
                    @if($i <= $rating)
                            <i class="fas fa-star fa-3x text-warning cursor-pointer"></i>
                        @else
                            <i class="far fa-star fa-3x text-warning cursor-pointer"></i>
                        @endif
                </span>
                </button>

            @endfor

        </div>

        <p class="text-[10px] mt-4">{{ number_format($rating, 1) }} based on {{ $serviceProvider->serviceReviewRatings->count() }} reviews</p>
    </div>

    <!-- Rating Modal -->
    <div class="absolute top-[-40px] w-[400px] mt-4 {{ !$showModal ? 'hidden' : '' }}" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center">
            <div class="w-full bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add your comments for {{ $serviceProvider->company_name }}
                            </h3>
                            <div class="mt-2">
                                <textarea wire:model="comments" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="Add your comments here..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="saveRating" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button wire:click="$set('showModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
