<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact; 
use App\Subscriber;
use App\Upload;

class ContactController extends Controller
{

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
        $contact = Contact::first();
        $title = $contact->title;
        $description = $contact->description;
        return view("frontend.contact_page", compact('title', 'description'));
    }

    public function save_subscriber(Request $request) {
        $sub = new Subscriber();
        $sub->first_name = $request->first_name;
        $sub->last_name = $request->last_name;
        $sub->phone_number = $request->phone_number;
        $sub->email = $request->email;
        $sub->message = $request->message;
        if ($request->hasFile("file")) {
            $upload = new Upload;

            $extension = strtolower($request->file('file')->getClientOriginalExtension());
            $file_original_name = explode('.', $request->file('file')->getClientOriginalName())[0];
            $path = $request->file('file')->store('uploads/all', 'local');
            $size = $request->file('file')->getSize();

            $upload->file_original_name = $file_original_name;
            $upload->extension = $extension;
            $upload->file_name = $path;
            $upload->user_id = null;
            $upload->type = $request->file('file')->extension();
            $upload->file_size = $size;
            $upload->save();
            $sub->file_id = $upload->id;
        }
        $sub->save(); 
        
        return response()->json([
            "error" => false,
            "message" => "Your submission has been sent successfully.",
            "response_html" =>  `<div>
                <div class="response response--success">
                <p>Your submission has been sent successfully.</p>
                </div>
            </div>`
        ], 200);
    }
}
