<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = auth()->user()->reviews()->with('serviceProvider')->get();
        return view('reviews.index', compact('reviews'));
    }
}
