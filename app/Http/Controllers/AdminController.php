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
        $top_programs = Program::withCount('donationRecords');
        
        $total_organizations = \App\Organization::count();
        $total_programs = \App\Program::count();
        $pending_programs_count = \App\Program::where('status', 'pending')->count();

        if (auth()->user()->user_type == 'organization') {
            $org_ids = auth()->user()->organizations->pluck('id');
            $top_programs = $top_programs->whereIn('org_id', $org_ids);
            
            $total_organizations = auth()->user()->organizations->count();
            $total_programs = \App\Program::whereIn('org_id', $org_ids)->count();
            $pending_programs_count = \App\Program::whereIn('org_id', $org_ids)->where('status', 'pending')->count();
        }

        $top_programs = $top_programs->orderBy('donation_records_count', 'desc')
            ->limit(10)
            ->get();

        $pending_programs = [];
        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
            $pending_programs = Program::where('status', 'pending')->orderBy('created_at', 'desc')->limit(5)->get();
        }
            
        return view('backend.dashboard', compact('list_posts', 'top_programs', 'total_organizations', 'total_programs', 'pending_programs', 'pending_programs_count'));
    }
}
