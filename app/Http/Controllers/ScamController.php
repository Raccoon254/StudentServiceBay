<?php

namespace App\Http\Controllers;

use App\Models\ScamAlert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScamController extends Controller
{
    public function index(): View
    {
        $scams = ScamAlert::with('user', 'serviceProvider')->latest()->paginate(10);
        return view('scam.index', compact('scams'));
    }

}
