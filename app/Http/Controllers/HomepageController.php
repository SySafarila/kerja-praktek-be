<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;
use App\Models\Testimonial;

class HomepageController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(6)->get();

        return view('homepage', compact('news', 'testimonials'));
    }
}
