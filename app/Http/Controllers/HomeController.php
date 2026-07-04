<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_page()
    {
        $config = json_decode(get_setting('homepage_blocks_config'), true) ?? [];
        
        if (isset($config['blocks'])) {
            $ordered_blocks = [];
            foreach ($config['blocks'] as $key => $block) {
                if ($key == 'new_today' || $key == 'collections') continue;
                $ordered_blocks[] = [
                    'type' => $key,
                    'active' => $block['active'] ?? 1,
                    'title' => $block['title'] ?? '',
                    'subtitle' => $block['subtitle'] ?? '',
                    'style' => $block['style'] ?? 'slide',
                    'columns' => $block['columns'] ?? 4,
                    'limit' => $block['limit'] ?? 12,
                    'collection_id' => null
                ];
            }
            if (isset($config['custom_collections'])) {
                foreach ($config['custom_collections'] as $cc) {
                    $ordered_blocks[] = [
                        'type' => 'custom_collection',
                        'active' => 1,
                        'title' => $cc['title'] ?? '',
                        'subtitle' => '',
                        'style' => $cc['style'] ?? 'slide',
                        'columns' => $cc['columns'] ?? 4,
                        'limit' => $cc['limit'] ?? 12,
                        'collection_id' => $cc['collection_id']
                    ];
                }
            }
        } elseif (is_array($config) && count($config) > 0 && isset($config[0]['type'])) {
            $ordered_blocks = [];
            foreach ($config as $block) {
                if ($block['type'] == 'new_today' || $block['type'] == 'collections') continue;
                $ordered_blocks[] = [
                    'type' => $block['type'],
                    'active' => $block['active'] ?? 1,
                    'title' => $block['title'] ?? '',
                    'subtitle' => $block['subtitle'] ?? '',
                    'style' => $block['style'] ?? 'slide',
                    'columns' => $block['columns'] ?? 4,
                    'limit' => $block['limit'] ?? 12,
                    'collection_id' => $block['collection_id'] ?? null
                ];
            }
        } else {
            $ordered_blocks = [
                ['type' => 'trending', 'active' => 1, 'title' => 'Thịnh Hành Hôm Nay 🔥', 'subtitle' => 'Outfit mọi người đang lưu nhiều nhất', 'style' => 'slide', 'columns' => 4, 'limit' => 12, 'collection_id' => null],
                ['type' => 'reels', 'active' => 1, 'title' => 'Video Reels 🎬', 'subtitle' => 'Ý tưởng trang phục nhanh trong 15 giây', 'style' => 'slide', 'columns' => 5, 'limit' => 12, 'collection_id' => null],
            ];
        }

        // Extract limit values for main blocks
        $trending_limit = 12;
        $reels_limit = 12;
        foreach ($ordered_blocks as $block) {
            if ($block['type'] === 'trending') {
                $trending_limit = $block['limit'] ?? 12;
            } elseif ($block['type'] === 'reels') {
                $reels_limit = $block['limit'] ?? 12;
            }
        }

        $trending_outfits = \App\Outfit::where('is_trending', true)
            ->with(['collections', 'items'])
            ->orderBy('saves_count', 'desc')
            ->limit($trending_limit)
            ->get();

        $reels = \App\Reel::orderBy('created_at', 'desc')
            ->limit($reels_limit)
            ->get();

        foreach ($ordered_blocks as &$block) {
            if ($block['type'] == 'custom_collection') {
                $collection = \App\Collection::find($block['collection_id']);
                if ($collection) {
                    $block['collection_slug'] = $collection->slug;
                    $block['outfits'] = $collection->outfits()
                        ->with(['collections', 'items'])
                        ->orderBy('created_at', 'desc')
                        ->limit($block['limit'] ?? 12)
                        ->get();
                } else {
                    $block['outfits'] = collect();
                }
            }
        }

        return view('frontend.home_page', compact('trending_outfits', 'reels', 'ordered_blocks'));
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

    public function collection_outfits($slug)
    {
        $collection = \App\Collection::where('slug', $slug)->firstOrFail();

        $outfits = $collection->outfits()
            ->with(['collections', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.collections.show', compact('collection', 'outfits'));
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $rawKeyword = $request->input('search');
        $outfits = \App\Outfit::query();

        if ($rawKeyword) {
            $cleanKeyword = \Illuminate\Support\Str::lower(trim($rawKeyword));

            // Stop words filtering
            $stopWords = [
                'cách phối đồ', 'phối đồ', 'cách mặc', 'outfit', 'set đồ', 
                'sét đồ', 'đồ', 'bộ đồ', 'kiểu', 'phong cách'
            ];

            $coreKeyword = $cleanKeyword;
            foreach ($stopWords as $word) {
                if (\Illuminate\Support\Str::startsWith($coreKeyword, $word)) {
                    $coreKeyword = trim(\Illuminate\Support\Str::replaceFirst($word, '', $coreKeyword));
                }
            }

            if (empty($coreKeyword)) {
                $coreKeyword = $cleanKeyword;
            }

            $unaccentedKeyword = \Illuminate\Support\Str::slug($coreKeyword, ' ');

            $outfits = $outfits->where(function($query) use ($coreKeyword, $unaccentedKeyword) {
                $query->where('title', 'like', "%{$coreKeyword}%")
                      ->orWhere('story', 'like', "%{$coreKeyword}%")
                      ->orWhere('hashtags', 'like', "%{$coreKeyword}%")
                      ->orWhere('title', 'like', "%{$unaccentedKeyword}%")
                      ->orWhere('hashtags', 'like', "%{$unaccentedKeyword}%");

                $query->orWhereHas('items', function($q) use ($coreKeyword, $unaccentedKeyword) {
                    $q->where('name', 'like', "%{$coreKeyword}%")
                      ->orWhere('name', 'like', "%{$unaccentedKeyword}%");
                });

                $query->orWhereHas('collections', function($q) use ($coreKeyword, $unaccentedKeyword) {
                    $q->where('title', 'like', "%{$coreKeyword}%")
                      ->orWhere('title', 'like', "%{$unaccentedKeyword}%")
                      ->orWhere('slug', 'like', '%' . \Illuminate\Support\Str::slug($coreKeyword) . '%');
                });
            });
        }

        $outfits = $outfits->with(['collections', 'items'])
                           ->orderBy('saves_count', 'desc')
                           ->paginate(12);

        return view('frontend.search', [
            'outfits' => $outfits,
            'keyword' => $rawKeyword
        ]);
    }

    public function reels_index()
    {
        if (get_setting('enable_video_reels', '1') !== '1') {
            return redirect()->route('home');
        }
        $reels = \App\Reel::orderBy('created_at', 'desc')->paginate(12);
        return view('frontend.reels.index', compact('reels'));
    }

    public function reel_detail($id)
    {
        if (get_setting('enable_video_reels', '1') !== '1') {
            return redirect()->route('home');
        }
        $reel = \App\Reel::with(['outfit.items', 'outfit.collections'])->findOrFail($id);
        
        // Increment views count
        $reel->increment('views_count');

        // Fetch other reels
        $other_reels = \App\Reel::where('id', '!=', $reel->id)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('frontend.reels.show', compact('reel', 'other_reels'));
    }

    public function about_page()
    {
        return view('frontend.pages.about');
    }

    public function privacy_page()
    {
        return view('frontend.pages.privacy');
    }

    public function affiliate_page()
    {
        return view('frontend.pages.affiliate');
    }

    public function trending_outfits()
    {
        $outfits = \App\Outfit::where('is_trending', 1)
            ->with(['collections', 'items'])
            ->orderBy('saves_count', 'desc')
            ->paginate(12);

        return view('frontend.trending', compact('outfits'));
    }

    public function outfit_like(Request $request, $id)
    {
        $outfit = \App\Outfit::findOrFail($id);
        $action = $request->input('action', 'like');

        if ($action === 'like') {
            $outfit->increment('likes_count');
        } else {
            if ($outfit->likes_count > 0) {
                $outfit->decrement('likes_count');
            }
        }

        return response()->json([
            'success' => true,
            'likes_count' => $outfit->likes_count,
            'formatted_likes' => $outfit->formatted_likes
        ]);
    }

    public function outfit_save(Request $request, $id)
    {
        $outfit = \App\Outfit::findOrFail($id);
        $action = $request->input('action', 'save');

        if ($action === 'save') {
            $outfit->increment('saves_count');
        } else {
            if ($outfit->saves_count > 0) {
                $outfit->decrement('saves_count');
            }
        }

        return response()->json([
            'success' => true,
            'saves_count' => $outfit->saves_count,
            'formatted_saves' => $outfit->formatted_saves
        ]);
    }

    public function reel_like(Request $request, $id)
    {
        $reel = \App\Reel::findOrFail($id);
        $action = $request->input('action', 'like');

        if ($action === 'like') {
            $reel->increment('likes_count');
        } else {
            if ($reel->likes_count > 0) {
                $reel->decrement('likes_count');
            }
        }

        return response()->json([
            'success' => true,
            'likes_count' => $reel->likes_count,
            'formatted_likes' => $reel->formatted_likes
        ]);
    }

    public function reel_save(Request $request, $id)
    {
        $reel = \App\Reel::findOrFail($id);
        $action = $request->input('action', 'save');

        if ($action === 'save') {
            $reel->increment('saves_count');
        } else {
            if ($reel->saves_count > 0) {
                $reel->decrement('saves_count');
            }
        }

        return response()->json([
            'success' => true,
            'saves_count' => $reel->saves_count,
            'formatted_saves' => $reel->formatted_saves
        ]);
    }

    public function reel_view($id)
    {
        $reel = \App\Reel::findOrFail($id);
        $reel->increment('views_count');

        return response()->json([
            'success' => true,
            'views_count' => $reel->views_count,
            'formatted_views' => $reel->formatted_views
        ]);
    }
}
