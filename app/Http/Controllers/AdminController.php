<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {
        $list_posts = Blog::where('status', 1)->orderBy('published_date', 'desc')->paginate(15);
        return view('backend.dashboard', compact('list_posts'));
    }
}
