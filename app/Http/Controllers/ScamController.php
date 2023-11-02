<?php

namespace App\Http\Controllers;

use App\Models\ScamAlert;
use App\Models\ServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ScamController extends Controller
{
    public function index(): View
    {
        $scams = ScamAlert::with('user', 'serviceProvider')->latest()->paginate(10);
        return view('scam.index', compact('scams'));
    }

    public function create() : View
    {
        $serviceProviders = ServiceProvider::all();
        return view('scam.create')->with('serviceProviders', $serviceProviders);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'service_provider' => 'required|exists:service_providers,id',
            'description' => 'required|string|max:1000',
            'location_area' => 'required|string|max:255',
        ]);

        // Create a new scam alert
        $scamAlert = ScamAlert::create([
            'service_provider' => $validatedData['service_provider'],
            'description' => $validatedData['description'],
            'date_reported' => now(),
            'location_area' => $validatedData['location_area'],
            'reported_by' => Auth::id(), // Assuming the user is authenticated
        ]);

        // Redirect to the scam alert page
        return redirect()->route('scam.show', $scamAlert);
    }

    public function show(ScamAlert $scam): View
    {
        $scam->load('user', 'serviceProvider');
        //dd($scam->serviceProvider->company_name);
        return view('scam.show', compact('scam'));
    }

}
