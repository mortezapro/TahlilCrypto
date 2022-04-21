<?php

namespace App\Http\Controllers;

use App\Helpers\Images;
use App\Http\Requests\VideoRequest;
use App\Models\VideoModel;
use App\Services\Category\CategoryService;
use App\Services\Gallery\GalleryService;
use App\Services\Video\VideoService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public VideoService $videoService;
    public CategoryService $categoryService;
    public GalleryService $galleryService;

    public function __construct()
    {
        $this->videoService = App::make(VideoService::class);
        $this->categoryService = App::make(CategoryService::class);
        $this->galleryService = App::make(GalleryService::class);
    }

    public function index()
    {
        $videos = $this->videoService->paginate(10);
        return view("panel.videos.index",compact("videos"));
    }

    public function create()
    {
        return view("panel.videos.new");
    }

    public function edit(VideoModel $video)
    {
        return view("panel.videos.edit",compact("video"));
    }

    public function store(VideoRequest $request, VideoModel $video = null)
    {
        $videoData = $request->all();
        $videoData["user_id"] = Auth::id();

        if($request->file("thumbnail")){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"thumbnail",config("upload_image_path.video-thumbnail"));
            $videoData["thumbnail"] = $thumbnailName;
        }

        if(array_key_exists("seo_image",$videoData)){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"seo_image",config("upload_image_path.seo-image"));
            $videoData["seo_image"] = $thumbnailName;
        }
        if(!array_key_exists("indexable",$videoData)){
            $videoData["indexable"] = 0;
        }
        if(!array_key_exists("highlight",$videoData)){
            $videoData["highlight"] = 0;
        }
        if(!array_key_exists("is_special",$videoData)){
            $videoData["is_special"] = 0;
        }

        $video ? $this->videoService->save($videoData,$video->id) : $video = $this->videoService->save($videoData);

        // there is a situation that video has not changed, but gallery request changed. this situation VideoObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request
        if(array_key_exists("gallery",$videoData)){
            $this->galleryService->uploadGallery($video,$videoData["gallery"]);
        }
        if(array_key_exists("category",$videoData)){
            $this->categoryService->syncCategory($video,$videoData["category"]);
        }

        if($video){
            return redirect()->route('admin.videos.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(VideoModel $video)
    {
        if( $this->videoService->delete($video) ){
            return redirect()->route("admin.videos.index")->with("delete",true);
        }
    }
}
