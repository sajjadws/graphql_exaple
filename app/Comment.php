<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'user_id', 'article_id', 'body', 'approved',
    ];


    public function user(){

        return $this->belongsTo(User::class);
    }


    public function article(){

        return $this->belongsTo(Article::class);
    }
}
