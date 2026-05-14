<?php

namespace App\Http\Controllers;

use App\DonationRecord;
use App\Program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationRecordController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_program = null;
        $sort_status = null;

        $donation_records = DonationRecord::orderBy('created_at', 'desc');

        if ($request->search != null) {
            $donation_records = $donation_records->where('id', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        if ($request->program_id != null && $request->program_id !== '') {
            $donation_records = $donation_records->where('program_id', (int) $request->program_id);
            $sort_program = $request->program_id;
        }

        if ($request->status != null && $request->status !== '') {
            $donation_records = $donation_records->where('status', $request->status);
            $sort_status = $request->status;
        }

        $programs = Program::orderBy('name')->get();
        $donation_records = $donation_records->paginate(15);

        return view('backend.donation_records.index', compact('donation_records', 'programs', 'sort_search', 'sort_program', 'sort_status'));
    }

    public function create()
    {
        $programs = Program::where('status', 'activated')->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('backend.donation_records.create', compact('programs', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'             => 'required|integer|exists:users,id',
            'program_id'          => 'required|integer|exists:programs,id',
            'status'              => 'required|in:Registered,Completed,Canceled',
            'check_in_time'       => 'nullable|date',
            'blood_type_verified' => 'nullable|string|max:255',
            'blood_volume'        => 'nullable|integer|min:0',
            'health_status'       => 'nullable|string',
            'failure_reason'      => 'nullable|string',
            'notes'               => 'nullable|string',
            'EmailConfirm'        => 'nullable|string|max:255',
        ]);

        $donationRecord = new DonationRecord;
        $donationRecord->fill($validated);
        $donationRecord->registration_time = now();
        $donationRecord->save();

        flash(translate('Donation record has been created successfully'))->success();
        return redirect()->route('donation-records.index');
    }

    public function edit($id)
    {
        $donationRecord = DonationRecord::findOrFail($id);
        $programs = Program::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('backend.donation_records.edit', compact('donationRecord', 'programs', 'users'));
    }

    public function update(Request $request, $id)
    {
        $donationRecord = DonationRecord::findOrFail($id);

        $validated = $request->validate([
            'user_id'             => 'nullable|integer|exists:users,id',
            'program_id'          => 'nullable|integer|exists:programs,id',
            'status'              => 'required|in:Registered,Completed,Canceled',
            'check_in_time'       => 'nullable|date',
            'blood_type_verified' => 'nullable|string|max:255',
            'blood_volume'        => 'nullable|integer|min:0',
            'health_status'       => 'nullable|string',
            'failure_reason'      => 'nullable|string',
            'notes'               => 'nullable|string',
        ]);

        $donationRecord->fill($validated);
        if ($donationRecord->EmailConfirm == null) {
            $donationRecord->EmailConfirm = auth()->user()->email;
        }
        $donationRecord->save();

        flash(translate('Donation record has been updated successfully'))->success();
        return redirect()->route('donation-records.index');
    }

    public function destroy($id)
    {
        DonationRecord::findOrFail($id)->delete();
        flash(translate('Donation record has been deleted successfully'))->success();
        return redirect()->route('donation-records.index');
    }
}
