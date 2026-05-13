<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\BlogCategory;
use App\Blog;
use App\Upload;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $post_id = null;
        $sort_search = null;
        $sort_status = null;
        $sort_category_ids = null;
        $sort_published_date_range = null;
        $sort_author = null;
        $blogs = Blog::orderBy('created_at', 'desc');
        if ($request->post_id != null) {
            $blogs = $blogs->where(['id' => $request->post_id]);
            $post_id = $request->post_id;
        }

        if ($request->status != null) {
            $blogs = $blogs->orWhere(['status' => $request->status]);
            $sort_status = $request->status;
        }

        if ($request->search != null){
            $blogs = $blogs->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        if ($request->published_date_range != null) {
            $date_range_array = explode(' to ', $request->published_date_range);
            $start_time = localTimeToUtc($date_range_array[0]);
            $end_time = localTimeToUtc($date_range_array[1]);
            $blogs = $blogs->where('published_date', '>=', $start_time)->where('published_date', '<=', $end_time);
            $sort_published_date_range = $request->published_date_range;
        }

        if ($request->category_ids != null) {
            $sort_category_ids = $request->category_ids;
            $blogs = $blogs->whereHas('category', function($query) use ($request) {
                return $query->whereIn('id', $request->category_ids);
            });
        }

        if ((!isset($request->author) || trim($request->author) === '') == false) {
            $blogs = $blogs->whereHas('author', function($query) use ($request) {
                return $query->where('name', 'LIKE', '%'.$request->author.'%');
            });
            $sort_author = $request->author;
        }
        
       

        $list_categories = BlogCategory::where(['status' => 1])->get();
        $blogs = $blogs->paginate(15);

        return view('backend.blog_system.blog.index', compact('blogs','sort_search', 'sort_category_ids', 'sort_published_date_range',
         'sort_author', 'sort_status', 'list_categories','post_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('backend.blog_system.blog.create', compact('blog_categories'));
    }

    public function save_blog_image(Request $request)
    {
        $type = array(
            "jpg"=>"image",
            "jpeg"=>"image",
            "png"=>"image",
            "svg"=>"image",
            "webp"=>"image",
            "gif"=>"image",
        );
        $status = false;
        if($request->hasFile('file')){
            $upload = new Upload();
            $extension = strtolower($request->file('file')->getClientOriginalExtension());

            if(isset($type[$extension])){
                $upload->file_original_name = null;
                $arr = explode('.', $request->file('file')->getClientOriginalName());
                for($i=0; $i < count($arr)-1; $i++){
                    if($i == 0){
                        $upload->file_original_name .= $arr[$i];
                    }
                    else{
                        $upload->file_original_name .= ".".$arr[$i];
                    }
                }

                $path = $request->file('file')->store('uploads/all', 'local');
                $size = $request->file('file')->getSize();

                if($type[$extension] == 'image' && get_setting('disable_image_optimization') != 1){
                    try {
                        $img = Image::make($request->file('file')->getRealPath())->encode();
                        $height = $img->height();
                        $width = $img->width();
                        if($width > $height && $width > 1500){
                            $img->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }elseif ($height > 1500) {
                            $img->resize(null, 800, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $img->save(base_path('public/').$path);
                        clearstatcache();
                        $size = $img->filesize();

                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }
                $upload->extension = $extension;
                $upload->file_name = $path;
                $upload->user_id = Auth::user()->id;
                $upload->type = $type[$upload->extension];
                $upload->file_size = $size;
                $upload->save();
                $status = true;
            }
        }
        return response()->json([
            'success' => $status,
            'location' => uploaded_asset($upload->id),
        ]);
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
            'category_id' => 'required',
            'title' => 'required|max:255',
            'banner' => 'required'
        ]);

        $blog = new Blog;
        
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $request->banner;
        $blog->slug = Str::slug($request->title, '-');
        $blog->short_description = $request->short_description;
        $blog->description = $request->description; 
        $blog->user_id = Auth::user()->id;
        
        $blog->meta_title = $request->meta_title;
        $blog->meta_img = $request->meta_img;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->save();
       
        flash(translate('You has been created successfully'))->success();
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $blog_categories = BlogCategory::all();

        return view('backend.blog_system.blog.edit', compact('blog','blog_categories'));
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
            'category_id' => 'required',
            'title' => 'required|max:255',
            'banner' => 'required'
        ]);

        $blog = Blog::find($id);

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $request->banner;
        $blog->slug = Str::slug($request->title, '-');
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        
        $blog->meta_title = $request->meta_title;
        $blog->meta_img = $request->meta_img;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->post_modified = currentTimeUtc();
        $blog->save();

        flash(translate('You has been updated successfully'))->success();
        return redirect()->route('blog.index');
    }
    
    public function change_status(Request $request) {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;
        if ($request->status == 1) {
            $blog->published_date = currentTimeUtc();
        }
        
        $blog->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();
        flash(translate('You has been soft delete successfully'))->success();
        return redirect('admin/blog');
    }


    public function all_blog() {
        $blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view("frontend.blog.listing", compact('blogs'));
    }
    
    public function blog_details($slug) {
        $blog = Blog::where('slug', $slug)->first();
        return view("frontend.blog.details", compact('blog'));
    }
}
