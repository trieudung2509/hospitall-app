<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact; 
use App\Subscriber;
use App\Upload;

class ContactController extends Controller
{
    public function admin_index() {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);
        return view('backend.contact.admin_index', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $contact = Contact::first();
        if ($contact == null) {
            $contact = new Contact();
            $contact->title = null;
            $contact->description = null;
            $contact->save();
        } 

        return view('backend.contact.index',  compact('contact'));
    }

    public function update(Request $request)
    {

        $contact = Contact::first();
        $contact->title = $request->title;
        $contact->description = $request->short_description;
        $contact->save();
        flash(translate('Update has been updated successfully'))->success();
        return redirect()->back();
    }

    // FE
    public function contact_page() {
        return view("frontend.contact_page");
    }

    public function store(Request $request) {
        $contact = new Contact();
        $contact->name = $request->user_name;
        $contact->email = $request->user_email;
        $contact->subject = $request->email_subject;
        $contact->message = $request->email_message;
        $contact->save();
        
        if ($request->ajax()) {
            return response()->json([
                "status" => 1,
                "msg" => translate("Your message has been sent successfully."),
            ], 200);
        }

        flash(translate('Your message has been sent successfully'))->success();
        return redirect()->back();
    }

    public function save_subscriber(Request $request) {
        // Keeping existing for backward compatibility if needed elsewhere
        $sub = new Subscriber();
        $sub->first_name = $request->user_name;
        $sub->email = $request->user_email;
        $sub->message = $request->email_message;
        $sub->save(); 
        
        return response()->json([
            "error" => false,
            "message" => "Your submission has been sent successfully.",
        ], 200);
    }
}
