<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Program;

class CampaignController extends Controller
{
    public function index()
    {
        // querry data từ database ra.
        $programs = Program::where('status', 'activated')->latest()->paginate(10);

        // truyền data xuống view.
        return view('frontend.campaign', compact('programs'));
    }

    public function details($slug = null)
    {
        $program = Program::where('slug', $slug)->first();
        if (!$program) {
            $program = Program::findOrFail($slug);
        }

        $next_program = Program::where('id', '>', $program->id)->where('status', 'activated')->orderBy('id', 'asc')->first();
        $prev_program = Program::where('id', '<', $program->id)->where('status', 'activated')->orderBy('id', 'desc')->first();

        return view('frontend.detail_campaign', compact('program', 'next_program', 'prev_program'));
    }
}
