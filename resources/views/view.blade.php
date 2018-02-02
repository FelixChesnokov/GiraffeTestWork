@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <?php if(Auth::check()) { ?>
        <p class="posts_list  text-center">View post</p>
        <div class="post">
            <p class="text-center"><b>{{$post->title}}</b></p>
            <hr>
            <p>{{$post->description}}</p>
            <hr>
            <span><b>Author:</b> </span><span>{{$post->author}}</span>
            <span><b>Date:</b> </span><span>{{$post->created_at}}</span>
            <?php if($post->author == $nameAuth) { ?>
                <div class="text-center">
                    <a href="{!! route('edit', ['id'=>$post->id]) !!}" ><button class="btn btn-info">Edit</button></a>
                    <input type="button" class="delete  btn btn-danger" value="Delete" rel="{{$post->id}}">
                </div>
            <?php }?>
        </div>
        <br>
    <?php }?>
    </div>
</div>
@endsection
