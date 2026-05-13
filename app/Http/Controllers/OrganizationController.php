<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Organization;
use App\OrganizationUser;
use App\Program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_type   = null;
        $sort_status = null;

        $organizations = Organization::orderBy('created_at', 'desc');

        if ($request->search != null) {
            $organizations = $organizations->where('org_name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        if ($request->org_type != null && $request->org_type !== '') {
            $organizations = $organizations->where('org_type', $request->org_type);
            $sort_type = $request->org_type;
        }

        if ($request->status !== null && $request->status !== '') {
            $organizations = $organizations->where('status', (int) $request->status);
            $sort_status = $request->status;
        }

        $organizations = $organizations->paginate(15);

        return view('backend.organizations.index', compact('organizations', 'sort_search', 'sort_type', 'sort_status'));
    }

    public function create()
    {
        return view('backend.organizations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'org_name'       => 'required|string|max:255',
            'org_type'       => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone'  => 'nullable|string|max:30',
            'contact_email'  => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'status'         => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($validated) {
            $org = Organization::create([
                'org_name'       => $validated['org_name'],
                'org_type'       => $validated['org_type'] ?? null,
                'contact_person' => $validated['contact_person'] ?? null,
                'contact_phone'  => $validated['contact_phone'] ?? null,
                'contact_email'  => $validated['contact_email'],
                'status'         => $validated['status'] ?? 1,
            ]);

            $user = User::create([
                'user_type'         => 'organization',
                'name'              => $org->org_name,
                'email'             => $org->contact_email,
                'phone'             => $org->contact_phone,
                'password'          => Hash::make(Str::random(32)),
                'email_verified_at' => now(),
            ]);

            OrganizationUser::create([
                'user_id' => $user->id,
                'org_id'  => $org->id,
                'status'  => 1,
                'note'    => null,
            ]);
        });

        flash(translate('Organization has been created successfully'))->success();
        return redirect()->route('organizations.index');
    }

    public function show($id)
    {
        // unused; blog pattern leaves this empty
    }

    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        return view('backend.organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $organization = Organization::findOrFail($id);
        $pivot        = OrganizationUser::where('org_id', $organization->id)->first();
        $linkedUserId = $pivot ? $pivot->user_id : null;

        $validated = $request->validate([
            'org_name'       => 'required|string|max:255',
            'org_type'       => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone'  => 'nullable|string|max:30',
            'contact_email'  => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($linkedUserId)
                    ->whereNull('deleted_at'),
            ],
            'status'         => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($organization, $pivot, $validated) {
            $organization->update([
                'org_name'       => $validated['org_name'],
                'org_type'       => $validated['org_type'] ?? null,
                'contact_person' => $validated['contact_person'] ?? null,
                'contact_phone'  => $validated['contact_phone'] ?? null,
                'contact_email'  => $validated['contact_email'],
                'status'         => $validated['status'] ?? $organization->status,
            ]);

            if ($pivot && $pivot->user) {
                $pivot->user->update([
                    'name'  => $validated['org_name'],
                    'email' => $validated['contact_email'],
                    'phone' => $validated['contact_phone'] ?? null,
                ]);
            } else {
                Log::warning('Organization '.$organization->id.' has no linked user during update; skipping user sync.');
            }
        });

        flash(translate('Organization has been updated successfully'))->success();
        return redirect()->route('organizations.index');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $organization = Organization::findOrFail($id);

            Program::where('org_id', $organization->id)->delete();

            $userIds = OrganizationUser::where('org_id', $organization->id)->pluck('user_id');
            User::whereIn('id', $userIds)->delete();

            OrganizationUser::where('org_id', $organization->id)->delete();

            $organization->delete();
        });

        flash(translate('Organization has been deleted successfully'))->success();
        return redirect()->route('organizations.index');
    }

    public function change_status(Request $request)
    {
        $organization = Organization::findOrFail($request->id);
        $organization->status = (int) $request->status;
        $organization->save();
        return 1;
    }
}
