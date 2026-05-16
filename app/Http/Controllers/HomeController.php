<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Blog;
use App\SliderBanner;
use App\AboutUs;
use App\Program;

class HomeController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_page()
    {
        $list_categories = BlogCategory::Where(['status' => 1, 'is_home_page' => 1])->select('id', 'category_name', 'slug')->get();
        $slider_banner = SliderBanner::first();
        $about_us = AboutUs::first();
        $programs = Program::where('status', 'activated')->latest()->take(6)->get();

        return view('frontend.home_page', compact('list_categories', 'slider_banner', 'about_us', 'programs'));
    }
}
