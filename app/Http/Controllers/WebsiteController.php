<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
	public function header(Request $request)
	{
		return view('backend.website_settings.header');
	}
	public function footer(Request $request)
	{	
		$lang = $request->lang;
		return view('backend.website_settings.footer', compact('lang'));
	}
	public function pages(Request $request)
	{
		return view('backend.website_settings.pages.index');
	}
	public function appearance(Request $request)
	{
		return view('backend.website_settings.appearance');
	}

	public function homepage(Request $request)
	{
		$collections = \App\Collection::all();
		return view('backend.website_settings.homepage', compact('collections'));
	}

	public function homepage_update(Request $request)
	{
		// Save enable_video_reels setting
		$enable_video_reels = $request->has('enable_video_reels') ? '1' : '0';
		$ev_setting = \App\BusinessSetting::where('type', 'enable_video_reels')->first();
		if (!$ev_setting) {
			$ev_setting = new \App\BusinessSetting();
			$ev_setting->type = 'enable_video_reels';
		}
		$ev_setting->value = $enable_video_reels;
		$ev_setting->save();

		$blocks_config = [];
		if ($request->has('block_type')) {
			foreach ($request->block_type as $index => $type) {
				$isActive = isset($request->block_active[$index]) ? (int)$request->block_active[$index] : 0;
				
				$blocks_config[] = [
					'type' => $type,
					'active' => $isActive,
					'title' => $request->block_title[$index] ?? '',
					'subtitle' => $request->block_subtitle[$index] ?? '',
					'style' => $request->block_style[$index] ?? 'slide',
					'columns' => (int)($request->block_columns[$index] ?? 4),
					'limit' => (int)($request->block_limit[$index] ?? 12),
					'collection_id' => isset($request->block_collection_id[$index]) && $request->block_collection_id[$index] ? (int)$request->block_collection_id[$index] : null,
				];
			}
		}

		$setting = \App\BusinessSetting::where('type', 'homepage_blocks_config')->first();
		if (!$setting) {
			$setting = new \App\BusinessSetting();
			$setting->type = 'homepage_blocks_config';
		}
		$setting->value = json_encode($blocks_config);
		$setting->save();

		\Artisan::call('cache:clear');

		flash(translate('Homepage settings updated successfully'))->success();
		return back();
	}
}