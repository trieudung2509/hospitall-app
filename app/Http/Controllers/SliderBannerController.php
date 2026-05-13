<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderBanner;

class SliderBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_home()
    {
        $slider_banner = SliderBanner::first();
        if ($slider_banner == null) {
            $slider_banner = new SliderBanner();
            $slider_banner->short_description = null;
            $slider_banner->image_thumb_ids = null;
            $slider_banner->save();
        } 

        return view('backend.slider_banner.index',  compact('slider_banner'));
    }

    public function slider_update(Request $request) {
        $slider_banner = SliderBanner::first();
        $slider_banner->short_description = $request->short_description;
        $slider_banner->image_thumb_ids = $request->image_thumbnail;
        $slider_banner->save();
        flash(translate('Update has been updated successfully'))->success();
        return redirect()->back();
    }
}
