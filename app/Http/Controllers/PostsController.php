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
        if(!$post){
            return redirect()->route('welcome');
        }
        return view('edit',['post'=> $post]);
    }

    public function editPostRequest(Request $request, $id)
    {
        $post = Post::find($id);
        if($post) {
            $post = $post->editPost($request);
        } else {
            return redirect()->route('welcome');
        }
        $nameAuth = Auth::user()->name;
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

    public function deletePost(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $post = new Post();
            $post->where('id',$id)->delete();
        }
        return redirect()->route('welcome');
    }
}