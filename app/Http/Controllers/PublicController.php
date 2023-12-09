<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Subject;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function news()
    {
        $latestNews = News::latest()->take(10)->get();
        $randomNews = News::inRandomOrder()->take(10)->get();

        return view('public.news', compact('latestNews','randomNews'));
    }

    public function newsDetails($id)
    {
        $news = News::findOrFail($id);

        $imageUrl = $this->getFirstImageUrl($news->body);
        $randomNews = News::inRandomOrder()->take(10)->get();

        return view('public.news-detail', compact('news', 'imageUrl', 'randomNews'));
    }

    private function getFirstImageUrl($html)
    {
        // Use a regular expression to find the first <img> tag and extract the src attribute
        preg_match('/<img.*?src=["\'](.*?)["\'].*?>/', $html, $matches);

        // Return the URL if a match is found, otherwise, return an empty string
        return isset($matches[1]) ? $matches[1] : '';
    }

    public function subjects()
    {
        $subjects = Subject::all();
        return view('public.subjects', compact('subjects'));
    }
}
