<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;

class NewController extends Controller
{
    // FE
    public function news_page(Request $request, $slug = null) {
        $query = Blog::where('status', 1);
        $title = translate('Tất cả tin tức');
        $description = "";
        $search = $request->search;

        if ($slug) {
            $category = BlogCategory::where('slug', $slug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
                $title = $category->category_name;
                $description = $category->short_description;
            }
        }

        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
            $title = translate('Kết quả tìm kiếm cho') . ': "' . $search . '"';
        }

        $list_posts = $query->orderBy('published_date', 'DESC')
                            ->select('id','title','slug', 'short_description', 'description', 'published_date', 'banner')
                            ->paginate(12);
        
        $arrCategoryList = BlogCategory::where('status', 1)->select('id', 'category_name', 'slug', 'parent_id')->get();
        $recent_posts = Blog::where('status', 1)->orderBy('published_date', 'desc')->limit(3)->get();

        return view("frontend.news_page", compact('list_posts', 'title', 'slug', 'description', 'arrCategoryList', 'search', 'recent_posts'));
    }

    public function ajax_new_post($slug, Request $request) {
        $page = $request->query('page');
        $categoryId =  BlogCategory::Where('slug', $slug)->select('id')->first();
        $childrenIds = BlogCategory::Where('parent_id', $categoryId)->select('id')->get();
        $list_posts = Blog::Where('category_id', $categoryId)
                        ->orWhereIn('category_id', $childrenIds)->select('id','title','slug', 'short_description', 'description','banner', 'created_at')->paginate(12);
        $returnHTML = view('frontend.ajax_post',['list_posts'=> $list_posts, 'slug' => $slug, 'page' => (int)$page + 1])->render();
        return $returnHTML;
    }

    public function detail_page($slug) {
        $post = Blog::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        $arrCategoryList = BlogCategory::where('status', 1)->select('id', 'category_name', 'slug')->get();
        $recent_posts = Blog::where('status', 1)->orderBy('published_date', 'desc')->limit(3)->get();
        
        $next_post = Blog::where('id', '>', $post->id)->where('status', 1)->orderBy('id', 'asc')->first();
        $prev_post = Blog::where('id', '<', $post->id)->where('status', 1)->orderBy('id', 'desc')->first();

        return view("frontend.detail_page", compact('post', 'arrCategoryList', 'recent_posts', 'next_post', 'prev_post'));
    }
}
