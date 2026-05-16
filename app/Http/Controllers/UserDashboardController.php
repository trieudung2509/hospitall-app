<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonationRecord;
use Auth;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web']);
    }

    public function index()
    {
        $donation_records = DonationRecord::where('user_id', Auth::guard('web')->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.user.dashboard', compact('donation_records'));
    }
}
