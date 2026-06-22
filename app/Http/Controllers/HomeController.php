<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $testimonials = Testimonial::where('approved', true)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'categories',
            'featuredProducts',
            'testimonials'
        ));
    }
}