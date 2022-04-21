<?php

namespace App\Http\Controllers;

use App\Helpers\Images;
use App\Http\Requests\PostRequest;
use App\Models\PostModel;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\Category\CategoryService;
use App\Services\Gallery\GalleryService;
use App\Services\Post\PostService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public PostService $postService;
    public CategoryService $categoryService;
    public GalleryService $galleryService;

    public function __construct()
    {
        $this->postService = App::make(PostService::class);
        $this->categoryService = App::make(CategoryService::class);
        $this->galleryService = App::make(GalleryService::class);
    }

    public function index()
    {
        $posts = $this->postService->paginate(10);
        return view("panel.posts.index",compact("posts"));
    }

    public function create()
    {
        return view("panel.posts.new");
    }

    public function edit(PostModel $post)
    {
        return view("panel.posts.edit",compact("post"));
    }

    public function store(PostRequest $request, PostModel $post = null)
    {
        $postData = $request->all();
        $postData["user_id"] = Auth::id();

        if($request->file("thumbnail")){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"thumbnail",config("upload_image_path.post-thumbnail"));
            $postData["thumbnail"] = $thumbnailName;
        }

        if(array_key_exists("seo_image",$postData)){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"seo_image",config("upload_image_path.seo-image"));
            $postData["seo_image"] = $thumbnailName;
        }
        if(!array_key_exists("indexable",$postData)){
            $postData["indexable"] = 0;
        }
        if(!array_key_exists("highlight",$postData)){
            $postData["highlight"] = 0;
        }
        if(!array_key_exists("is_special",$postData)){
            $postData["is_special"] = 0;
        }

        $post ? $this->postService->save($postData,$post->id) : $post = $this->postService->save($postData);

        // there is a situation that post has not changed, but gallery request changed. this situation PostObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request
        if(array_key_exists("gallery",$postData)){
            $this->galleryService->uploadGallery($post,$postData["gallery"]);
        }
        if(array_key_exists("category",$postData)){
            $this->categoryService->syncCategory($post,$postData["category"]);
        }

        if($post){
            return redirect()->route('admin.posts.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(PostModel $post)
    {
        if( $this->postService->delete($post) ){
            return redirect()->route("admin.posts.index")->with("delete",true);
        }
    }

}
