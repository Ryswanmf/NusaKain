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
        
        $relatedPortfolios = Portfolio::where('is_published', true)
            ->where('category', $portfolio->category)
            ->where('id', '!=', $portfolio->id)
            ->latest()
            ->take(3)
            ->get();

        return view('landing_page.portofolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
