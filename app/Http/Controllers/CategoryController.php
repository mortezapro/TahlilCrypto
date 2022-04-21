<?php

namespace App\Http\Controllers;

use App\Helpers\Images;
use App\Http\Requests\CategoryRequest;
use App\Models\CategoryModel;
use App\Services\Category\CategoryService;
use App\Services\Post\PostService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    protected CategoryService $categoryService;
    protected PostService $postService;

    public function __construct()
    {
        $this->categoryService = App::make(CategoryService::class);
        $this->postService = App::make(PostService::class);
    }

    public function paginate()
    {
        return $this->categoryService->paginate(10);
    }

    public function index()
    {
        $categories = $this->categoryService->paginate(10);
        return view("panel.categories.index",compact("categories"));
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view("panel.categories.new",compact("categories"));
    }

    public function store(CategoryRequest $request, CategoryModel $category = null)
    {
        $categoryData = $request->all();
        $categoryData["user_id"] = Auth::id();

        if(array_key_exists("thumbnail",$categoryData)){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"thumbnail",config("upload_image_path.category-thumbnail"));
            $categoryData["thumbnail"] = $thumbnailName;
        }

        if(array_key_exists("seo_image",$categoryData)){
            $image = new Images();
            $thumbnailName = $image->uploadFile($request,"seo_image",config("upload_image_path.seo-image"));
            $categoryData["seo_image"] = $thumbnailName;
        }

        if(!array_key_exists("indexable",$categoryData)){
            $categoryData["indexable"] = 0;
        }
        if(!array_key_exists("is_special",$categoryData)){
            $categoryData["is_special"] = 0;
        }

        $category ? $this->categoryService->save($categoryData,$category->id) : $category = $this->categoryService->save($categoryData);


        if(array_key_exists("parent",$categoryData)){
            $this->categoryService->syncCategory($category,$categoryData["parent"]);
        }
        if($category){
            return redirect()->route('panel.categories.index')->with('save',true);
        }
        return abort(500);
    }

    public function destory(CategoryModel $category)
    {
        if( $this->categoryService->delete($category) ){
            return redirect()->route("admin.categories.index")->with("delete",true);
        }
    }

}
