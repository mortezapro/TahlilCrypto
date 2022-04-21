<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\CommentModel;
use App\Services\Comment\CommentService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{

    public CommentService $commentService;

    public function __construct()
    {
        $this->commentService = App::make(CommentService::class);
    }

    public function index()
    {
        $comments = $this->commentService->paginate(10);
        return view("panel.comments.index",compact("comments"));
    }

    public function create()
    {
        return view("panel.comments.new");
    }

    public function edit(CommentModel $comment)
    {
        return view("panel.comments.edit",compact("comment"));
    }

    public function store(CommentRequest $request, CommentModel $comment = null)
    {
        $commentData = $request->all();

        $comment ? $this->commentService->save($commentData,$comment->id) : $comment = $this->commentService->save($commentData);

        // there is a situation that comment has not changed, but gallery request changed. this situation CommentObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($comment){
            return redirect()->route('admin.comments.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(CommentModel $comment)
    {
        if( $this->commentService->delete($comment) ){
            return redirect()->route("admin.comments.index")->with("delete",true);
        }
    }

}
