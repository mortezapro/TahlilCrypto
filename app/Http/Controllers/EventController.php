<?php

namespace App\Http\Controllers;

use App\Helpers\Images;
use App\Http\Requests\EventRequest;
use App\Models\EventModel;
use App\Services\Category\CategoryService;
use App\Services\Event\EventService;
use App\Services\Gallery\GalleryService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public EventService $eventService;
    public CategoryService $categoryService;
    public GalleryService $galleryService;

    public function __construct()
    {
        $this->eventService = App::make(EventService::class);
        $this->categoryService = App::make(CategoryService::class);
        $this->galleryService = App::make(GalleryService::class);
    }

    public function index()
    {
        $events = $this->eventService->paginate(10);
        return view("panel.events.index",compact("events"));
    }

    public function create()
    {
        return view("panel.events.new");
    }

    public function edit(EventModel $event)
    {
        return view("panel.events.edit",compact("event"));
    }

    public function store(EventRequest $request, EventModel $event = null)
    {
        $eventData = $request->all();
        $eventData["user_id"] = Auth::id();

        if($request->file("thumbnail")){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"thumbnail",config("upload_image_path.event-thumbnail"));
            $eventData["thumbnail"] = $thumbnailName;
        }

        if(array_key_exists("seo_image",$eventData)){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"seo_image",config("upload_image_path.seo-image"));
            $eventData["seo_image"] = $thumbnailName;
        }
        if(!array_key_exists("indexable",$eventData)){
            $eventData["indexable"] = 0;
        }
        if(!array_key_exists("highlight",$eventData)){
            $eventData["highlight"] = 0;
        }
        if(!array_key_exists("is_special",$eventData)){
            $eventData["is_special"] = 0;
        }

        $event ? $this->eventService->save($eventData,$event->id) : $event = $this->eventService->save($eventData);

        // there is a situation that event has not changed, but gallery request changed. this situation EventObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request
        if(array_key_exists("gallery",$eventData)){
            $this->galleryService->uploadGallery($event,$eventData["gallery"]);
        }
        if(array_key_exists("category",$eventData)){
            $this->categoryService->syncCategory($event,$eventData["category"]);
        }

        if($event){
            return redirect()->route('admin.events.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(EventModel $event)
    {
        if( $this->eventService->delete($event) ){
            return redirect()->route("admin.events.index")->with("delete",true);
        }
    }

}
