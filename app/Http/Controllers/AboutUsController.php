<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AboutUs; 

class AboutUsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $about_us = AboutUs::first();
        if ($about_us == null) {
            $about_us = new AboutUs();
            $about_us->title = null;
            $about_us->description = null;
            $about_us->content = null;
            $about_us->save();
        } 

        return view('backend.about_us.index',  compact('about_us'));
    }

    public function update(Request $request)
    {

        $about_us = AboutUs::first();
        $about_us->title = $request->title;
        $about_us->description = $request->short_description;
        $about_us->content = $request->content;
        $about_us->save();
        flash(translate('Update has been updated successfully'))->success();
        return redirect()->back();
    }


    // FE
    public function about_page() {
        $about_us = AboutUs::first();
        if ($about_us) {
            $title = $about_us->title;
            $description = $about_us->description;
            $content = $about_us->content;
        }

        return view("frontend.about_us", compact('title', 'description', 'content'));
    }
}
