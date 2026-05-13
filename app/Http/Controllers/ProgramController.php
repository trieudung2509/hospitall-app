<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Organization;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_org    = null;
        $sort_status = null;

        $programs = Program::orderBy('created_at', 'desc');

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

        $organizations = Organization::orderBy('org_name')->get();
        $programs      = $programs->paginate(15);

        return view('backend.programs.index', compact('programs', 'organizations', 'sort_search', 'sort_org', 'sort_status'));
    }

    public function create()
    {
        $organizations = Organization::where('status', 1)->orderBy('org_name')->get();
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
            'start_time'       => 'required|date',
            'end_time'         => 'required|date|after:start_time',
            'max_participants' => 'nullable|integer|min:0',
            'reg_open_time'    => 'nullable|date',
            'reg_close_time'   => 'nullable|date|after:reg_open_time',
            'note'             => 'nullable|string',
        ]);

        $program = new Program;
        $program->fill($validated);
        $program->user_id     = Auth::id();
        $program->approved_by = Auth::id();
        $program->status      = 'activated';
        $program->save();

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
        $organizations = Organization::where('status', 1)->orderBy('org_name')->get();

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

        $validated = $request->validate([
            'org_id'           => 'required|integer|exists:organizations,id',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string|max:3000',
            'banner'           => 'nullable|integer',
            'location'         => 'nullable|string|max:255',
            'start_time'       => 'required|date',
            'end_time'         => 'required|date|after:start_time',
            'max_participants' => 'nullable|integer|min:0',
            'reg_open_time'    => 'nullable|date',
            'reg_close_time'   => 'nullable|date|after:reg_open_time',
            'note'             => 'nullable|string',
        ]);

        $program->fill($validated);
        $program->save();

        flash(translate('Program has been updated successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function destroy($id)
    {
        Program::findOrFail($id)->delete();
        flash(translate('Program has been deleted successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function change_status(Request $request)
    {
        $program = Program::findOrFail($request->id);
        // The toggle posts 0/1; map to the string enum stored in the column.
        $program->status = ((int) $request->status === 1) ? 'activated' : 'inActived';
        $program->save();
        return 1;
    }
}
