<?php
namespace App\Traits;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(CommentModel::class,"commentable")
            ->whereNull("reply_id")
            ->where("status",config("comment-status.published"))
            ->orderBy("id","desc")->orderBy("reply_id","desc");
    }

}
