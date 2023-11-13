<?php

namespace App\Http\Livewire;

use App\Models\ServiceReviewRating;
use Illuminate\View\View;
use Livewire\Component;

class UserReviews extends Component
{
    public $reviews;
    public bool $showEditModal = false;
    public string $currentReviewId;
    public string $currentReviewComments;
    public string $currentReviewRating;

    public function mount(): void
    {
        $this->reviews = auth()->user()->reviews()->with('serviceProvider')->get();
        //paginated reviews
        //$this->reviews = auth()->user()->reviews()->with('serviceProvider')->paginate(5);
    }

    public function edit($reviewId): void
    {
        $this->currentReviewId = $reviewId;
        $review = ServiceReviewRating::find($reviewId);
        $this->currentReviewComments = $review->comments;
        $this->currentReviewRating = $review->rating;
        $this->showEditModal = true;
    }

    public function update(): void
    {
        $this->validate([
            'currentReviewComments' => 'required|string|min:6',
            'currentReviewRating' => 'required|numeric|min:1|max:5',
        ]);

        $review = ServiceReviewRating::find($this->currentReviewId);
        $review->update([
            'comments' => $this->currentReviewComments,
            'rating' => $this->currentReviewRating,
        ]);

        $this->showEditModal = false;
        $this->mount(); // Refresh the reviews
    }

    public function closeModal(): void
    {
        $this->showEditModal = false;
    }

    public function render(): View
    {
        return view('livewire.user-reviews');
    }
}
