<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $sort_search =null;
        $categories = BlogCategory::query()->orderBy('display_order', 'desc')->orderBy('id', 'desc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('category_name', 'like', '%'.$sort_search.'%');
        }
        
        $categories = $categories->paginate(15);
        return view('backend.blog_system.category.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories = BlogCategory::all();
        return view('backend.blog_system.category.create', compact('all_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255',
        ]);
        
        $category = new BlogCategory;
        
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name, '-');
        $category->display_order =  $request->display_order != null ? $request->display_order : 0;
        // $category->description = $request->description;
        $category->short_description = $request->short_description;
        $category->parent_id = $request->parent_id != 0 ? $request->parent_id : null;
        $category->meta_title = $request->meta_title;
        $category->meta_img = $request->meta_img;
        $category->meta_description = $request->meta_description;
        $category->status = 1;
        
        $category->save();
        
        
        flash(translate('Blog category has been created successfully'))->success();
        return redirect()->route('blog-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cateogry = BlogCategory::find($id);
        $all_categories = BlogCategory::all();
        
        return view('backend.blog_system.category.edit',  compact('cateogry','all_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|max:255',
        ]);

        $category = BlogCategory::find($id);

        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name, '-');
        $category->display_order =  $request->display_order != null ? $request->display_order : 0;
        // $category->description = $request->description;
        $category->short_description = $request->short_description;
        $category->parent_id = $request->parent_id != 0 ? $request->parent_id : null;
        $category->meta_title = $request->meta_title;
        $category->meta_img = $request->meta_img;
        $category->meta_description = $request->meta_description;
        
        $category->save();
        
        
        flash(translate('Blog category has been updated successfully'))->success();
        return redirect()->route('blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogCategory::find($id)->delete();

        flash(translate('Blog category has been deleted successfully'))->success();
        return redirect()->route('blog-category.index');
    }

    public function change_status(Request $request) {
        $category = BlogCategory::find($request->id);
        $category->status = $request->status;
        
        $category->save();
        return 1;
    }

    public function change_home_page_status(Request $request) {
        $cateblog = BlogCategory::find($request->id);
        $cateblog->is_home_page = $request->status;
        
        $cateblog->save();
        return 1;
    }

    public function change_show_menu_status(Request $request) {
        $cateblog = BlogCategory::find($request->id);
        $cateblog->is_show_menu = $request->status;
        
        $cateblog->save();
        return 1;
    }
}
