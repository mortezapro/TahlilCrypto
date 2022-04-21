<?php

namespace App\Services\Gallery;

use App\Helpers\Images;
use App\Models\GalleryModel;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class GalleryService{

    public GalleryRepositoryInterface $galleryRepository;

    public function __construct()
    {
        $this->galleryRepository = App::make(GalleryRepositoryInterface::class);
    }

    public function uploadGallery($object,array $galleries)
    {
        // delete old galleries if exist
        if($object->galleries->count()){
            $this->deleteGalleriesWhenGalleryExist($object,public_path(config("upload_image_path.gallery")));
        }
        $galleryIds = [];
        $image = new Images();
        foreach ($galleries as $gallery) {
            // upload new gallery
            $fileName = explode(".", $gallery->getClientOriginalName())[0] . "." . $gallery->extension();
            if(file_exists(config("upload_image_path.gallery").$fileName)){
                $fileName = explode(".", $gallery->getClientOriginalName())[0] . Carbon::now()->toArray()["timestamp"] . "." . $gallery->extension();
            }
            $image->uploadSingleFile($gallery,public_path(config("upload_image_path.gallery")),$fileName);
            //save galleries path to database
            $galleryData = [
                "path"=>$fileName,
                "extension"=>$gallery->extension(),
            ];
            $galleryObject = $this->galleryRepository->save($galleryData);
            $galleryIds[] = $galleryObject->id;
        }

        // sync galleriable data
        $object->galleries()->sync($galleryIds);
    }

    // this function just called inside "UploadGallery function".
    // don't use this function for any service
    public function deleteGalleriesWhenGalleryExist($object,string $path)
    {
        foreach($object->galleries as $gallery){
            $image_url   = $path.$gallery->path;
            @unlink($image_url);
        }
        $object->galleries()->delete();
    }

    public function detachSingleGalleries(GalleryModel $gallery)
    {
        // delete gallery file
        @unlink(public_path(config("upload_image_path.gallery").$gallery->path));

        // detach galleriable for any entity that used it
        return $this->galleryRepository->detachGalleryOfAllEntity($gallery->id);
    }

    public function detachGalleries(Object $object,string $relation,string $galleriableType)
    {

        //delete gallery files
        if($object->galleries()->count()){
            foreach ($object->galleries as $gallery) {
                @unlink(public_path(config("upload_image_path.gallery").$gallery->path));
            }
        }

        // delete gallery
        $galleries = $this->getGalleryByObject($object,$relation,$galleriableType);
        foreach ($galleries as $gallery) {
            $this->galleryRepository->delete($gallery->id);
        }
        // detach galleriables
        $object->galleries()->detach();
    }

    public function getGalleryByObject(Object $object,string $relation,string $galleriableType)
    {
        return $this->galleryRepository->getGalleryByObject($object,$relation,$galleriableType);
    }
}
