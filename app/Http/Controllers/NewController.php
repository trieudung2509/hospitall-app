<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;

class NewController extends Controller
{
    // FE
    public function news_page($slug) {
        $first_category =  BlogCategory::Where('slug', $slug)->select('id', 'category_name', 'parent_id', 'short_description')->first();
        $categoryId = $first_category->id;
        $title = $first_category->category_name;
        $parent_id = $first_category->parent_id;
        $description = $first_category->short_description;
        $list_posts = Blog::Where(['category_id' => $categoryId, 'status' => 1])->orderBy('published_date', 'DESC')
                            ->select('id','title','slug', 'short_description', 'description', 'published_date', 'banner')->paginate(12);
        
        $arrCategoryList = BlogCategory::Where('status', 1)->select('id', 'category_name', 'slug', 'parent_id')->get();

        return view("frontend.news_page", compact('list_posts', 'title', 'slug', 'description', 'arrCategoryList'));
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

        return view("frontend.detail_page", compact('post'));
    }
}
