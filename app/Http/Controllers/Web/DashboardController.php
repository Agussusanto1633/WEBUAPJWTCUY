<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Display dashboard
     */
    public function index()
    {
        $totalServiceProviders = ServiceProvider::count();
        $totalCategories = Category::count();
        $recentServiceProviders = ServiceProvider::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalServiceProviders',
            'totalCategories',
            'recentServiceProviders'
        ));
    }
}
