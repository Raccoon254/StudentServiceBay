<?php

namespace App\Http\Livewire;

use App\Models\ServiceProvider;
use App\Models\ServiceReviewRating;
use Illuminate\View\View;
use Livewire\Component;

class ServiceProviderRating extends Component
{
    public ServiceProvider $serviceProvider;
    public $rating;
    public string $comments = '';
    public bool $showModal = false;

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

    public function saveRating(): \Illuminate\Http\RedirectResponse
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


        // refresh the rating
        $this->rating = $this->serviceProvider->serviceReviewRatings->avg('rating');
        $this->refreshData();
        $this->showModal = false;
        //redirect to the same page
        return redirect()->back()->with('success', 'Rating saved successfully');
    }

    public function refreshData(): void
    {
        $this->serviceProvider = ServiceProvider::find($this->serviceProvider->id);
        //$this->serviceProvider->load('serviceReviewRatings');

        //reload the rating
        $this->rating = $this->serviceProvider->serviceReviewRatings->avg('rating');
        //reload the whole page
        $this->emit('refreshParent');
    }


    public function render():View
    {
        return view('livewire.service-provider-rating')->with('rating', $this->rating)->with('serviceProvider', $this->serviceProvider);
    }
}
