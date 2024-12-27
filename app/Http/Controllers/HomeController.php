<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;

class HomeController extends Controller
{
    public function index()
    {
        $bestReviews = Avis::with('user')
            ->orderBy('note', 'desc')
            ->limit(3)
            ->get();
    
        return view('home', ['bestReviews' => $bestReviews]);
    }
}