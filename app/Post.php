<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        'title',
        'description',
        'author'
    ];

    public function addNewPost($request)
    {
        $posts = $this->create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'author'=>Auth::user()->name
        ]);
        return $posts;
    }

    public function editPost($request)
    {
        $this->title = $request->input('title');
        $this->description = $request->input('description');
        $this->save();
        return $this;
    }
}
