<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Program;
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
        $top_programs = Program::withCount('donationRecords')
            ->orderBy('donation_records_count', 'desc')
            ->limit(10)
            ->get();
            
        return view('backend.dashboard', compact('list_posts', 'top_programs'));
    }
}
