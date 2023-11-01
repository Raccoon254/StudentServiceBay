<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceProviderController extends Controller
{
    public function index(): View
    {
        $serviceProviders = ServiceProvider::all();
        return view('service-providers.index', compact('serviceProviders'));
    }
}
