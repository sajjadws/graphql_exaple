<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Post
 *
 * @mixin Eloquent
 */
class Article extends Model
{
    //

    protected $fillable = [
        'user_id', 'title', 'body', 'image'
    ];


    /// for get user that writel this article
    public function user(){

        return $this->belongsTo(User::class );
    }

    /// for get commtents of article
    public function comments(){

        return $this->hasMany(Comment::class);
    }

}
