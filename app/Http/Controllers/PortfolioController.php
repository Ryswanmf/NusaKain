<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('is_published', true)->orderBy('project_date', 'desc')->paginate(9);
        return view('landing_page.portofolio.index', compact('portfolios'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        return view('landing_page.portofolio.show', compact('portfolio'));
    }
}
