<?php
/**Created by kkoch**/

namespace App;

trait LikeableTrait
{

    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public function likeIt()
    {
        $like=new Like();
        $like->user_id=auth()->user()->id;

        $this->likes()->save($like);

        return $like;

    }

    public function unlikeIt()
    {
       // $like=Like::find($id);
        $this->likes()->where('user_id', auth()->id())->delete();
        //$like->destroy($id);


    }

    public function isLiked()
    {
        return (bool)$this->likes()->where('user_id', auth()->id())->count();
        /*the double exclamation mark return a boolean otherwise done as (bool)
        */
    }
}