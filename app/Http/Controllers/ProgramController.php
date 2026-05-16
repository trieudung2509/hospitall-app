<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Organization;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Notifications\ProgramNotification;
use Illuminate\Support\Facades\Notification;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_org    = null;
        $sort_status = null;

        $programs = Program::orderBy('start_time', 'desc');

        if (auth()->user()->user_type == 'organization') {
            $org_ids = auth()->user()->organizations->pluck('id');
            $programs = $programs->whereIn('org_id', $org_ids);
        }

        if ($request->search != null) {
            $programs = $programs->where('name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        if ($request->org_id != null && $request->org_id !== '') {
            $programs = $programs->where('org_id', (int) $request->org_id);
            $sort_org = $request->org_id;
        }

        if ($request->status != null && $request->status !== '') {
            $programs = $programs->where('status', $request->status);
            $sort_status = $request->status;
        }

        $organizations = Organization::orderBy('org_name');
        if (auth()->user()->user_type == 'organization') {
            $organizations = auth()->user()->organizations()->orderBy('org_name');
        }
        $organizations = $organizations->get();
        $programs      = $programs->paginate(15);

        return view('backend.programs.index', compact('programs', 'organizations', 'sort_search', 'sort_org', 'sort_status'));
    }

    public function create()
    {
        $organizations = Organization::where('organizations.status', 1)->orderBy('org_name');
        if (auth()->user()->user_type == 'organization') {
            $organizations = auth()->user()->organizations()->where('organizations.status', 1)->orderBy('org_name');
        }
        $organizations = $organizations->get();
        return view('backend.programs.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'org_id'           => 'required|integer|exists:organizations,id',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string|max:3000',
            'banner'           => 'nullable|integer',
            'location'         => 'nullable|string|max:255',
            'google_map'       => 'nullable|string',
            'start_time'       => 'required|date',
            'end_time'         => 'required|date|after:start_time',
            'max_participants' => 'nullable|integer|min:0',
            'short_description' => 'nullable|string|max:255',
            'note'             => 'nullable|string',
            'slug'             => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        if (auth()->user()->user_type == 'organization' && !auth()->user()->organizations->contains($request->org_id)) {
            flash(translate('Access Denied'))->danger();
            return back();
        }

        $program = new Program;
        $program->fill($validated);
        $program->user_id = Auth::id();
        
        if (auth()->user()->user_type == 'organization') {
            $program->status      = 'pending';
            $program->approved_by = null;
        } else {
            $program->status      = 'activated';
            $program->approved_by = Auth::id();
        }
        
        $program->save();

        if ($program->status == 'pending') {
            $users = User::whereIn('user_type', ['admin', 'staff'])->get();
            $notification_data = [
                'program_id'   => $program->id,
                'program_name' => $program->name,
                'org_name'     => $program->organization->org_name,
                'status'       => $program->status,
                'type'         => 'program_approval'
            ];
            Notification::send($users, new ProgramNotification($notification_data));
        }

        flash(translate('Program has been created successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function show($id)
    {
        // unused
    }

    public function edit($id)
    {
        $program       = Program::findOrFail($id);
        if (auth()->user()->user_type == 'organization' && !auth()->user()->organizations->contains($program->org_id)) {
            flash(translate('Access Denied'))->danger();
            return redirect()->route('programs.index');
        }
        $organizations = Organization::where('organizations.status', 1)->orderBy('org_name');
        if (auth()->user()->user_type == 'organization') {
            $organizations = auth()->user()->organizations()->where('organizations.status', 1)->orderBy('org_name');
        }
        $organizations = $organizations->get();

        // Ensure the program's current org appears in the dropdown even if it's now inactive
        // or soft-deleted, so the value isn't silently swapped.
        if (!$organizations->contains('id', $program->org_id)) {
            $current = Organization::withTrashed()->find($program->org_id);
            if ($current) {
                $organizations = $organizations->prepend($current);
            }
        }

        return view('backend.programs.edit', compact('program', 'organizations'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);
        if (auth()->user()->user_type == 'organization' && !auth()->user()->organizations->contains($program->org_id)) {
            flash(translate('Access Denied'))->danger();
            return redirect()->route('programs.index');
        }

        $validated = $request->validate([
            'org_id'           => 'required|integer|exists:organizations,id',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string|max:3000',
            'banner'           => 'nullable|integer',
            'location'         => 'nullable|string|max:255',
            'google_map'       => 'nullable|string',
            'start_time'       => 'required|date',
            'end_time'         => 'required|date|after:start_time',
            'max_participants' => 'nullable|integer|min:0',
            'short_description' => 'nullable|string|max:255',
            'note'             => 'nullable|string',
            'slug'             => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'status'           => 'nullable|in:pending,activated,inActived',
        ]);

        if (auth()->user()->user_type == 'organization' && !auth()->user()->organizations->contains($request->org_id)) {
            flash(translate('Access Denied'))->danger();
            return back();
        }

        $program->fill($validated);

        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
            if ($request->has('status')) {
                if ($request->status == 'activated' && $program->status != 'activated') {
                    $program->approved_by = auth()->id();
                }
                $program->status = $request->status;
            }
        }

        $program->save();

        flash(translate('Program has been updated successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        if (auth()->user()->user_type == 'organization' && !auth()->user()->organizations->contains($program->org_id)) {
            flash(translate('Access Denied'))->danger();
            return redirect()->route('programs.index');
        }
        $program->delete();
        flash(translate('Program has been deleted successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function change_status(Request $request)
    {
        $program = Program::findOrFail($request->id);
        if (auth()->user()->user_type == 'organization' && !auth()->user()->organizations->contains($program->org_id)) {
            return 0;
        }
        if ($request->status == 1) {
            $program->status = 'activated';
            if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
                $program->approved_by = auth()->id();
            }
        } else {
            $program->status = 'inActived';
        }
        $program->save();
        return 1;
    }
}
