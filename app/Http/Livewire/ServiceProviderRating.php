<?php

namespace App\Http\Livewire;

use App\Models\ServiceReviewRating;
use Illuminate\View\View;
use Livewire\Component;

class ServiceProviderRating extends Component
{
    public $serviceProvider;
    public $rating;
    public $comments = '';
    public $showModal = false;

    public function mount($serviceProvider): void
    {
        $this->serviceProvider = $serviceProvider;
        $this->rating = $serviceProvider->serviceReviewRatings->avg('rating');
    }

    public function setRating($rating): void
    {
        $this->rating = $rating;
        $this->showModal = true;  // show the modal for adding comments
    }

    public function saveRating(): void
    {
        $existingRating = ServiceReviewRating::where('user_id', auth()->id())
            ->where('service_provider_id', $this->serviceProvider->id)
            ->first();

        if($existingRating) {
            $existingRating->update(['rating' => $this->rating, 'comments' => $this->comments]);
        } else {
            ServiceReviewRating::create([
                'user_id' => auth()->id(),
                'service_provider_id' => $this->serviceProvider->id,
                'rating' => $this->rating,
                'comments' => $this->comments,
                'date_reviewed' => now(),
            ]);
        }

        $this->showModal = false;
        // refresh the rating
        $this->rating = $this->serviceProvider->serviceReviewRatings->avg('rating');
    }

    public function render():View
    {
        return view('livewire.service-provider-rating');
    }
}
