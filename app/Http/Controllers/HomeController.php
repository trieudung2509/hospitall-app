<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_page()
    {
        $trending_outfits = \App\Outfit::where('is_trending', true)
            ->with(['collections', 'items'])
            ->orderBy('saves_count', 'desc')
            ->limit(4)
            ->get();

        $new_outfits = \App\Outfit::with(['collections', 'items'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $collections = \App\Collection::withCount('outfits')
            ->limit(6)
            ->get();

        return view('frontend.home_page', compact('trending_outfits', 'new_outfits', 'collections'));
    }

    public function outfit_detail($slug)
    {
        $outfit = \App\Outfit::where('slug', $slug)
            ->with(['collections', 'items', 'creator'])
            ->firstOrFail();

        // Increment views count
        $outfit->increment('views_count');

        // Fetch related outfits (sharing some collections)
        $collectionIds = $outfit->collections->pluck('id')->toArray();
        $related_outfits = \App\Outfit::where('id', '!=', $outfit->id)
            ->whereHas('collections', function ($q) use ($collectionIds) {
                $q->whereIn('collections.id', $collectionIds);
            })
            ->limit(4)
            ->get();

        return view('frontend.outfits.show', compact('outfit', 'related_outfits'));
    }
}
