<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DonationRecord;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $user = User::where('email', $request->user_email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $request->user_name;
            $user->email = $request->user_email;
            $user->phone = $request->user_phone;
            $user->user_type = 'participants';
            $user->password = bcrypt(Str::random(10));
            $user->save();
        }

        $donationRecord = new DonationRecord();
        $donationRecord->user_id = $user->id;
        $donationRecord->program_id = $request->program_id;
        $donationRecord->status = 'Registered';
        $donationRecord->registration_time = now();
        // Optional: Save other fields to notes or specific columns if they exist in donation_records
        $donationRecord->notes = $request->email_message;
        $donationRecord->save();

        if ($request->ajax()) {
            return response()->json([
                "status" => 1,
                "msg" => translate("Your appointment has been registered successfully."),
            ], 200);
        }

        flash(translate('Your appointment has been registered successfully'))->success();
        return redirect()->back();
    }
}
