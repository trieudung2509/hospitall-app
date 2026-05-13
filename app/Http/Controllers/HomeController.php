<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Blog;
use App\SliderBanner;

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

        return view('frontend.home_page', compact('list_categories', 'slider_banner'));
    }
}
