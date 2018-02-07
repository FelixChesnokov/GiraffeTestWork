<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //add post
    {
        return view('add');
    }

    public function welcome()
    {
        $posts = DB::table('posts')->paginate(5);
        $nameAuth = Auth::user()->name;
        return view('welcome', ['posts'=>$posts, 'nameAuth'=>$nameAuth]);
    }

    public function addPostRequest(PostsRequest $request)
    {
        $post = new Post();
        $post = $post->addNewPost($request);
        $nameAuth = Auth::user()->name;
        return view('view')->with(['id',$post->id, 'post'=>$post, 'nameAuth'=>$nameAuth]);
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        $nameAuth = Auth::user()->name;
        if(!$post || $post->author != $nameAuth){
            return redirect()->route('welcome');
        }
        return view('edit',['post'=> $post]);
    }

    public function editPostRequest(PostsRequest $request, $id)
    {
        $nameAuth = Auth::user()->name;
        $post = Post::find($id);
        if($post && $post->author == $nameAuth) {
            $post = $post->editPost($request);
        } else {
            return redirect()->route('welcome');
        }
        return view('view')->with(['id',$post->id, 'post'=>$post, 'nameAuth'=>$nameAuth]);
    }

    public function viewPost($id)
    {
        $post = Post::find($id);
        $nameAuth = Auth::user()->name;
        if(!$post)
        {
            return redirect()->route('welcome');
        } else {
            return view('view')->with(['id',$post->id, 'post'=>$post, 'nameAuth'=>$nameAuth]);
        }
    }

    public function deletePost($id)
    {
//        if($request->ajax()){
//            $id = $request->input('id');
//            $post = Post::find($id);
//            $nameAuth = Auth::user()->name;
//            if($nameAuth == $post->author){
//                $post->delete();
//            }
//        }

        $post = Post::find($id);
        $nameAuth = Auth::user()->name;
        if($post && $nameAuth == $post->author){
            $post->delete();
        } else {
            return redirect()->route('welcome');
        }
        return redirect()->route('welcome');
    }
}
